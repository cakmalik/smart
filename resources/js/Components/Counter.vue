<template>
    <div>
        <button @click="count++">{{ count }}</button>

        <select @change="cobaFungsi">
            <option v-for="(formal, index) in formal" :key="index">
                {{ formal.name }}
            </option>
        </select>
    </div>
</template>
 
<script setup>
import { ref } from "vue";
import axios from "axios";
const count = ref(1);
const props = defineProps({
    formal: {
        type: Array,
        required: true,
    },
});

const cobaFungsi = async () => {
    try {
        let res = await axios.get("https://jsonplaceholder.typicode.com/users");
        let data = res.data;
        console.log(data);
    } catch (error) {
        console.log(error);
    }
};
</script>
