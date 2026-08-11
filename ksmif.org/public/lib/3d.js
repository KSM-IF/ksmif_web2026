import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

// Menggunakan Document Ready dari jQuery
$(document).ready(function() {
    
    // --- SETUP DASAR MENGGUNAKAN JQUERY ---
    const $container = $('#wadah-3d'); // Ambil elemen dengan jQuery
    const containerEle = $container[0]; // Ambil elemen DOM asli untuk Three.js
    
    // Ambil ukuran menggunakan fungsi jQuery
    let width = $container.innerWidth();
    let height = $container.innerHeight();

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
    camera.position.z = 2.5;

    // --- RENDERER ---
    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(width, height);
    renderer.setClearColor(0x000000, 0); // Transparan
    
    // Pasang kanvas ke dalam div menggunakan jQuery .append()
    $container.append(renderer.domElement);

    // --- 3D OBJ ---
    let myModel; // Variabel global untuk menyimpan model agar bisa diakses di animasi
    const loader = new GLTFLoader();

    loader.load(
        'images/icon/ksm3d.glb', 
        function (gltf) {
            myModel = gltf.scene;
            scene.add(myModel);
        },
        function (xhr) {
            // Tampilkan progress loading di console
            console.log( ( xhr.loaded / xhr.total * 100 ) + '% loaded' );
        },
        function (error) {
            console.error( 'Gagal memuat model', error );
        }
    );

    // --- PENCAHAYAAN (LIGHTING) ---
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff, 2);
    directionalLight.position.set(5, 5, 5);
    scene.add(directionalLight);

    // --- ORBIT CONTROLS ---
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    controls.enableZoom = true;

    // --- ANIMATION LOOP ---
    function animate() {
        requestAnimationFrame(animate);

        if (myModel) {
            myModel.rotation.y += 0.01;
        }
        controls.update();

        renderer.render(scene, camera);
    }
    animate();

    // --- EVENT JQUERY: MENANGANI PERUBAHAN UKURAN (RESIZE) ---
    $(window).on('resize', function() {
        width = $container.innerWidth();
        height = $container.innerHeight();

        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
    });

    // --- EVENT JQUERY: TOMBOL UBAH WARNA ---
    $('#wadah-3d').on('click', function() {
        if (myModel) {
            const randomColor = Math.random() * 0xffffff;
            myModel.traverse(function (child) {
                if (child.isMesh) {
                    // Ubah warna material dari masing-masing potongan
                    child.material.color.setHex(randomColor);
                }
            });
        }
    });

});