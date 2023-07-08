<template>
    <div class="card">
        <div class="card-header p-3">
            Chatroom
            <span class="badge bg-secondary float-end">{{ usersInChat }}</span>
        </div>
        <div class="card-body gap-2">
            <chat-log :messages="messages"></chat-log>
            <chat-composer></chat-composer>
        </div>
    </div>
</template>

<script setup>
import ChatLog from './ChatLog.vue';
import ChatComposer from './ChatComposer.vue';
import { ref, onBeforeMount } from 'vue';
import axios from 'axios';
import { usePusher } from '../stores/pusher.js';

let messages = ref([]);
let usersInChat = ref(0);
let pusher = usePusher();
let channel = pusher.pusher.subscribe('presence-chatroom');

onBeforeMount(() => {
    axios.get('/messages').then(response => {
        messages.value = response.data.messages;
    });

    channel.bind('message.sent', data => {
        messages.value.push({
            message: data.message,
            sender: {
                name: data.sender
            }
        });
    });

    channel.bind('pusher:subscription_succeeded', () => {
        usersInChat.value = channel.members.count;
    });

    channel.bind('pusher:member_added', () => {
        usersInChat.value = channel.members.count;
    });

    channel.bind('pusher:member_removed', member => {
        usersInChat.value = channel.members.count;
    });
});

</script>