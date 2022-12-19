<template>
    Testing...


</template>

<script setup>

import {onMounted, ref} from "vue";
import axios from 'axios';

let students = ref([])

function loadStudents() {
    axios.get("/students")
        .then((response) => {
            students.value = response.data;
        })
        .catch(() => {
            console.error("Failed loading students.")
        })
}

onMounted(function () {
    loadStudents()
})
</script>
