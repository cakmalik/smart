import 'flowbite';
import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";
import "../css/choices.scss";

import { initFlowbite } from 'flowbite'

import { createApp, defineAsyncComponent } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";

const el = document.getElementById("app");

createApp({
    mounted() {
        // bisa panggil jquery disini loh
        initFlowbite();

    },
    render: renderSpladeApp({ el }),
})
    .use(SpladePlugin, {
        suppress_compile_errors: true,
        max_keep_alive: 10,
        transform_anchors: true, //mengubah anchor menjadi spa juga
        progress_bar: false,
    })
    .component('Counter', defineAsyncComponent(() => import("./Components/Counter.vue")))   
    .mount(el);
