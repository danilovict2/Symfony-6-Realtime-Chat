<template>
    <div class="chat-composer d-flex">
        <input type="text" placeholder="Start typing your message..." v-model="messageText" @keydown.enter="sendMessage">
        <button href="" class="btn btn-primary" @click="sendMessage">Send</button>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';

const emit = defineEmits(['messageSent']);
let messageText = ref('');

function sendMessage() {
    axios.post('/message/create', null, { 
        params: {
            message: messageText.value
        }
    });
    messageText.value = '';
}

</script>

<style>
.chat-composer {
    display: flex;
}

.chat-composer input {
    flex: 1 auto;
    padding: .5rem 1rem;
}

.chat-composer button {
    border-radius: 0;
}

</style>