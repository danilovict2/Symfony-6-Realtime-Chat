<template>
    <div class="chat-message">
        <p>{{ message }}</p>
        <small>{{ user }}</small>
    </div>
</template>

<script setup>

defineProps({
    user: String,
    message: String
})

</script>

<style>
.chat-message {
    padding: 1rem;
}

.chat-message > p {
    margin-bottom: .5rem;
}
</style>