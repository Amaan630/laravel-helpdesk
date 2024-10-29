<template>
    <div :class="['mb-4', message.is_from_user ? 'text-right' : 'text-left']">
        <div
            :class="[
                'inline-block px-3 py-1.5 rounded-xl text-sm',
                message.is_from_user
                    ? 'bg-brand-500 text-white'
                    : 'bg-gray-100 text-gray-800',
            ]"
        >
            {{ message.content }}
        </div>
        <div class="text-xs text-gray-500 mt-1">
            {{ formatDate(message.created_at) }}
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "ChatMessage",
    props: {
        message: {
            type: Object,
            required: true,
        },
    },
    methods: {
        formatDate(dateString) {
            return moment(dateString).fromNow();
        },
    },
};
</script>
