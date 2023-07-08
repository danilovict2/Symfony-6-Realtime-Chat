<template>
    <chat-log :messages="messages"></chat-log>
    <chat-composer @messageSent="handleSentMessage"></chat-composer>
</template>

<script setup>
import ChatLog from './ChatLog.vue';
import ChatComposer from './ChatComposer.vue';
import { ref, onBeforeMount } from 'vue';
import axios from 'axios';
import { usePusher } from '../stores/pusher.js';

let messages = ref([]);
let pusher = usePusher();

onBeforeMount(() => {
    axios.get('/messages').then(response => {
        messages.value = response.data.messages;
    });

    let channel = pusher.pusher.subscribe('chatroom');
    channel.bind('message.sent', (data) => {
        messages.value.push({
            message: data.message,
            sender: {
                name: data.sender
            }
        });
    });
});

function handleSentMessage(message) {
    axios.post('/message/create', null, { 
        params: {
            message: message.message
        }
    });
    
}

</script>