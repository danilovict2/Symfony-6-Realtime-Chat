<template>
    <div class="chat-composer d-flex">
        <input type="text" placeholder="Start typing your message..." v-model="messageText" @keydown.enter="sendMessage">
        <button href="" class="btn btn-primary" @click="sendMessage">Send</button>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const emit = defineEmits(['messageSent']);
let messageText = ref('');

function sendMessage() {
    emit('messageSent', {
        user: 'John Doe',
        message: messageText.value,
    });
    messageText.value = '';
}

</script>

<style>

.chat-composer input {
    flex: 1 auto;
}

.chat-composer button {
    border-radius: 0;
}

</style>