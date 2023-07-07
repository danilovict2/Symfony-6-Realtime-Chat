<template>
    <h1>Chatroom</h1>
    <chat-log :messages="messages"></chat-log>
    <chat-composer @messageSent="handleSentMessage"></chat-composer>
</template>

<script setup>
import ChatLog from './ChatLog.vue';
import ChatComposer from './ChatComposer.vue';
import { ref, onBeforeMount } from 'vue';
import axios from 'axios';

let messages = ref([]);

onBeforeMount(() => {
    axios.get('/messages').then(response => {
        messages.value = response.data.messages;
    });
});

function handleSentMessage(message) {
    axios.post('/message/create', null, { 
        params: {
            message: message.message
        }
    });
    messages.value.push(message);
}

</script>