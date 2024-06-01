import "flowbite";
import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";
import "../css/choices.scss";
import Menu from "./Components/Menu.vue";
import Counter from "./Components/Counter.vue";
import Mouse from "./Components/Mouse.vue";
import { initFlowbite } from "flowbite";

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
        max_keep_alive: 5,
        transform_anchors: true, //mengubah anchor menjadi spa juga
        progress_bar: {
            delay: 250,
            color: "#0FFF50",
            css: true,
            spinner: true,
        },
        components: {
            Counter,
            Menu,
            Mouse,
        },
    })

    .mount(el);
