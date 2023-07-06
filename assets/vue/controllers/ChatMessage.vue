<template>
    <div class="chat-message">
        <p>{{ message }}</p>
        <small>{{ user }}</small>
    </div>
</template>

<script setup>
import { ref } from 'vue';

let message = ref('This is some message');
let user = ref('John Doe');

</script>

<style>
.chat-message {
    padding: 1rem;
}

.chat-message > p {
    margin-bottom: .5rem;
}
</style>