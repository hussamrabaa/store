import Alpine from 'alpinejs';

const STORAGE_KEY = 'store.cart.v1';

function readCart() {
    try {
        const raw = localStorage.getItem(STORAGE_KEY);
        const parsed = raw ? JSON.parse(raw) : [];
        return Array.isArray(parsed) ? parsed : [];
    } catch (error) {
        return [];
    }
}

function persist(items) {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
    } catch (error) {
        // Storage may be unavailable (private mode); keep in-memory state working.
    }
    window.dispatchEvent(new CustomEvent('cart:updated'));
}

document.addEventListener('alpine:init', () => {
    Alpine.store('cart', {
        items: readCart(),

        init() {
            window.addEventListener('cart:updated', () => {
                this.items = readCart();
            });
        },

        get count() {
            return this.items.reduce((total, item) => total + Number(item.qty || 0), 0);
        },

        get subtotal() {
            return this.items.reduce((total, item) => total + Number(item.price || 0) * Number(item.qty || 0), 0);
        },

        get shipping() {
            return this.subtotal === 0 || this.subtotal >= 50 ? 0 : 4.99;
        },

        get total() {
            return this.subtotal + this.shipping;
        },

        money(value) {
            return '$' + Number(value || 0).toFixed(2);
        },

        add(product, qty = 1) {
            const items = readCart();
            const existing = items.find((item) => String(item.id) === String(product.id));

            if (existing) {
                existing.qty = Number(existing.qty) + Number(qty);
            } else {
                items.push({
                    id: product.id,
                    name: product.name,
                    price: Number(product.price),
                    image: product.image || null,
                    qty: Number(qty),
                });
            }

            persist(items);
        },

        update(id, qty) {
            let items = readCart();
            const quantity = Math.max(0, Number(qty));
            const item = items.find((entry) => String(entry.id) === String(id));

            if (quantity === 0) {
                items = items.filter((entry) => String(entry.id) !== String(id));
            } else if (item) {
                item.qty = quantity;
            }

            persist(items);
        },

        remove(id) {
            persist(readCart().filter((entry) => String(entry.id) !== String(id)));
        },

        clear() {
            persist([]);
        },
    });
});
