<template>
    <chat-log :messages="messages"></chat-log>
    <chat-composer @messageSent="handleSentMessage"></chat-composer>
</template>

<script setup>
import ChatLog from './ChatLog.vue';
import ChatComposer from './ChatComposer.vue';
import { ref } from 'vue';

let messages = ref([
    {
        user: 'John Doe',
        message: 'Hey!'
    },
    {
        user: 'Jane Doe',
        message: 'Hello!'
    }
]);

function handleSentMessage(message) {
    messages.value.push(message);
}

</script>