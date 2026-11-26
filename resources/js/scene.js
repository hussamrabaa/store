import * as THREE from 'three';

const isDark = () => document.documentElement.classList.contains('dark');

export function initBackgroundScene(selector = '#bg-scene') {
    const container = document.querySelector(selector);
    if (!container) return null;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    let renderer;
    try {
        renderer = new THREE.WebGLRenderer({
            antialias: true,
            alpha: true,
            powerPreference: 'high-performance',
        });
    } catch (error) {
        return null;
    }

    const width = container.clientWidth || window.innerWidth;
    const height = container.clientHeight || window.innerHeight;

    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
    renderer.setSize(width, height);
    renderer.setClearAlpha(0);
    renderer.domElement.style.display = 'block';
    renderer.domElement.style.width = '100%';
    renderer.domElement.style.height = '100%';
    container.appendChild(renderer.domElement);

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(60, width / height, 0.1, 1000);
    camera.position.set(0, 0, 30);

    const isSmall = window.innerWidth < 768;

    // Floating particle cloud
    const count = isSmall ? 900 : 1800;
    const spread = 60;
    const positions = new Float32Array(count * 3);
    for (let i = 0; i < count; i++) {
        positions[i * 3] = (Math.random() - 0.5) * spread;
        positions[i * 3 + 1] = (Math.random() - 0.5) * spread * 0.72;
        positions[i * 3 + 2] = (Math.random() - 0.5) * spread * 0.6;
    }

    const pointsGeometry = new THREE.BufferGeometry();
    pointsGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

    const pointsMaterial = new THREE.PointsMaterial({
        size: isSmall ? 0.5 : 0.38,
        sizeAttenuation: true,
        transparent: true,
        depthWrite: false,
    });

    const points = new THREE.Points(pointsGeometry, pointsMaterial);
    scene.add(points);

    // Slowly rotating wireframe "mesh" volume
    const meshGeometry = new THREE.EdgesGeometry(new THREE.IcosahedronGeometry(12, 1));
    const meshMaterial = new THREE.LineBasicMaterial({
        transparent: true,
        depthWrite: false,
    });

    const wireframe = new THREE.LineSegments(meshGeometry, meshMaterial);
    wireframe.position.set(isSmall ? 4 : 7, 0, -10);
    scene.add(wireframe);

    const applyTheme = () => {
        if (isDark()) {
            pointsMaterial.color.set('#818cf8');
            pointsMaterial.opacity = 0.9;
            pointsMaterial.blending = THREE.AdditiveBlending;
            meshMaterial.color.set('#38bdf8');
            meshMaterial.opacity = 0.22;
            meshMaterial.blending = THREE.AdditiveBlending;
        } else {
            pointsMaterial.color.set('#6366f1');
            pointsMaterial.opacity = 0.55;
            pointsMaterial.blending = THREE.NormalBlending;
            meshMaterial.color.set('#7c3aed');
            meshMaterial.opacity = 0.13;
            meshMaterial.blending = THREE.NormalBlending;
        }

        pointsMaterial.needsUpdate = true;
        meshMaterial.needsUpdate = true;
    };

    applyTheme();

    const themeObserver = new MutationObserver(applyTheme);
    themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

    // Parallax input: pointer on desktop, physical device tilt on mobile
    const pointer = { x: 0, y: 0, targetX: 0, targetY: 0 };

    const isMobile = window.matchMedia('(pointer: coarse)').matches
        && window.matchMedia('(hover: none)').matches;

    const onPointerMove = (event) => {
        pointer.targetX = (event.clientX / window.innerWidth) * 2 - 1;
        pointer.targetY = (event.clientY / window.innerHeight) * 2 - 1;
    };

    // Device orientation (tilt) state — mobile only
    const tiltRange = 25; // degrees of tilt for full movement
    const clamp = (value, min, max) => Math.min(max, Math.max(min, value));
    let tiltBaseline = null;

    const onDeviceOrientation = (event) => {
        if (event.beta === null || event.gamma === null) return;

        const angle = (screen.orientation && screen.orientation.angle) || window.orientation || 0;
        let tiltX = event.gamma;
        let tiltY = event.beta;

        if (angle === 90) {
            tiltX = event.beta;
            tiltY = -event.gamma;
        } else if (angle === 180) {
            tiltX = -event.gamma;
            tiltY = -event.beta;
        } else if (angle === 270 || angle === -90) {
            tiltX = -event.beta;
            tiltY = event.gamma;
        }

        // Treat the phone's starting angle as neutral.
        if (!tiltBaseline) {
            tiltBaseline = { x: tiltX, y: tiltY };
            return;
        }

        pointer.targetX = clamp((tiltX - tiltBaseline.x) / tiltRange, -1, 1);
        pointer.targetY = clamp((tiltY - tiltBaseline.y) / tiltRange, -1, 1);
    };

    let tiltEnabled = false;
    const enableTilt = () => {
        if (tiltEnabled) return;
        tiltEnabled = true;
        window.addEventListener('deviceorientation', onDeviceOrientation, { passive: true });
    };

    const resetTiltBaseline = () => {
        tiltBaseline = null;
    };

    const requestTiltPermission = () => {
        window.removeEventListener('touchend', requestTiltPermission);
        window.removeEventListener('click', requestTiltPermission);

        if (typeof DeviceOrientationEvent !== 'undefined'
            && typeof DeviceOrientationEvent.requestPermission === 'function') {
            DeviceOrientationEvent.requestPermission()
                .then((state) => {
                    if (state === 'granted') enableTilt();
                })
                .catch(() => {});
        } else {
            enableTilt();
        }
    };

    if (!prefersReducedMotion) {
        if (isMobile && typeof window.DeviceOrientationEvent !== 'undefined') {
            // iOS requires a user gesture before orientation events are available.
            if (typeof DeviceOrientationEvent.requestPermission === 'function') {
                window.addEventListener('touchend', requestTiltPermission, { passive: true });
                window.addEventListener('click', requestTiltPermission);
            } else {
                enableTilt();
            }

            window.addEventListener('orientationchange', resetTiltBaseline);
        } else {
            window.addEventListener('pointermove', onPointerMove, { passive: true });
        }
    }

    const resize = () => {
        const w = container.clientWidth || window.innerWidth;
        const h = container.clientHeight || window.innerHeight;
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        renderer.setSize(w, h);
    };

    const resizeObserver = new ResizeObserver(resize);
    resizeObserver.observe(container);

    const clock = new THREE.Clock();
    let elapsed = 0;
    let frameId = null;

    const renderFrame = () => {
        const delta = Math.min(clock.getDelta(), 0.1);
        elapsed += delta;

        if (!prefersReducedMotion) {
            points.rotation.y = elapsed * 0.035;
            points.rotation.x = Math.sin(elapsed * 0.1) * 0.08;

            wireframe.rotation.y = -elapsed * 0.08;
            wireframe.rotation.x = elapsed * 0.05;

            pointer.x += (pointer.targetX - pointer.x) * 0.05;
            pointer.y += (pointer.targetY - pointer.y) * 0.05;

            camera.position.x = pointer.x * 3;
            camera.position.y = -pointer.y * 2;
            camera.lookAt(0, 0, 0);
        }

        renderer.render(scene, camera);
    };

    const loop = () => {
        frameId = requestAnimationFrame(loop);
        renderFrame();
    };

    if (prefersReducedMotion) {
        renderFrame();
    } else {
        loop();
    }

    const onVisibilityChange = () => {
        if (prefersReducedMotion) return;

        if (document.hidden) {
            if (frameId) cancelAnimationFrame(frameId);
            frameId = null;
        } else if (!frameId) {
            loop();
        }
    };

    document.addEventListener('visibilitychange', onVisibilityChange);

    return {
        destroy() {
            if (frameId) cancelAnimationFrame(frameId);
            document.removeEventListener('visibilitychange', onVisibilityChange);
            window.removeEventListener('pointermove', onPointerMove);
            window.removeEventListener('deviceorientation', onDeviceOrientation);
            window.removeEventListener('orientationchange', resetTiltBaseline);
            window.removeEventListener('touchend', requestTiltPermission);
            window.removeEventListener('click', requestTiltPermission);
            resizeObserver.disconnect();
            themeObserver.disconnect();
            pointsGeometry.dispose();
            pointsMaterial.dispose();
            meshGeometry.dispose();
            meshMaterial.dispose();
            renderer.dispose();
            renderer.domElement.remove();
        },
    };
}
