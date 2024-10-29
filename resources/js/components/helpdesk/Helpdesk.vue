<template>
    <div class="fixed bottom-5 right-5 z-50 flex flex-col items-end">
        <!-- Chat Window -->
        <transition
            enter-active-class="transition ease-out duration-300"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-if="isOpen"
                class="bg-white rounded-lg shadow-xl border border-color w-80 mb-4"
            >
                <div class="p-4 border-b relative">
                    <!-- New close button -->
                    <button
                        @click="toggleHelpdesk"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                    <div class="flex items-center">
                        <!-- <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-10 w-10 rounded-full bg-brand-500 text-brand-50 p-1 mr-3"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                            />
                        </svg> -->
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="h-10 w-10 rounded-full text-brand-500 p-1 mr-3"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                clip-rule="evenodd"
                            />
                        </svg>

                        <!-- src="https://images.unsplash.com/photo-1634149134165-6d679d80a800?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDF8fHxlbnwwfHx8fHw%3D" -->
                        <!-- <img
                            src="https://static.diverseui.com/male-17.jpg"
                            class="w-10 h-10 object-cover object-top rounded-full"
                        /> -->

                        <div>
                            <h3 class="font-semibold">Radar Feedback</h3>
                            <p class="text-sm text-gray-500">
                                Any feedback for us?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-4 h-80 overflow-y-auto" ref="messageContainer">
                    <div
                        v-if="messages.length === 0"
                        class="flex flex-col items-center justify-center h-full text-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-16 h-16 text-gray-300 mb-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"
                            />
                        </svg>
                        <p class="text-gray-500 font-medium">No messages yet</p>
                        <p class="text-sm text-gray-400 mt-2">
                            Start the conversation by sending a message!
                        </p>
                    </div>
                    <chat-message
                        v-else
                        v-for="message in messages"
                        :key="message.id"
                        :message="message"
                    />
                </div>
                <div class="p-4 border-t">
                    <form @submit.prevent="sendMessage">
                        <input
                            v-model="newMessage"
                            type="text"
                            placeholder="Write a message..."
                            class="w-full p-2 rounded border"
                            ref="messageInput"
                        />
                    </form>
                </div>
            </div>
        </transition>

        <!-- Helpdesk Button -->
        <button
            @click="toggleHelpdesk"
            class="bg-brand-500 text-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105"
        >
            <transition name="icon" mode="out-in">
                <svg
                    v-if="!isOpen"
                    key="chat"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"
                    />
                </svg>
                <svg
                    v-else
                    key="close"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </transition>
        </button>
    </div>
</template>

<script>
import ChatMessage from "./ChatMessage.vue";
import axios from "axios";

export default {
    name: "Helpdesk",
    components: {
        ChatMessage,
    },
    data() {
        return {
            isOpen: false,
            messages: [],
            newMessage: "",
            pollInterval: null,
            isScrolledToBottom: true,
        };
    },
    methods: {
        toggleHelpdesk() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.loadMessages(true);
                this.startPolling();
                this.$nextTick(() => {
                    this.$refs.messageInput.focus();
                });
            } else {
                this.stopPolling();
            }
        },
        async loadMessages(firstTime = false) {
            try {
                const response = await axios.get("/api/messages", {
                    params: {
                        user_uuid: this.$page.props.auth.user.uuid,
                    },
                });
                this.messages = response.data;
                if (firstTime) {
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                }
            } catch (error) {
                console.error("Error loading messages:", error);
            }
        },
        async sendMessage() {
            if (!this.newMessage.trim()) return;

            try {
                const response = await axios.post("/api/messages", {
                    content: this.newMessage,
                    user_uuid: this.$page.props.auth.user.uuid,
                });
                this.messages.push(...response.data);
                this.newMessage = "";
                this.$nextTick(() => {
                    this.scrollToBottom();
                });
            } catch (error) {
                console.error("Error sending message:", error);
            }
        },
        startPolling() {
            this.pollInterval = setInterval(this.loadMessages, 5000); // Poll every 5 seconds
        },
        stopPolling() {
            clearInterval(this.pollInterval);
        },
        scrollToBottom() {
            if (this.isScrolledToBottom) {
                const container = this.$refs.messageContainer;
                container.scrollTop = container.scrollHeight;
            }
        },
        handleScroll() {
            const container = this.$refs.messageContainer;
            const { scrollTop, scrollHeight, clientHeight } = container;
            this.isScrolledToBottom =
                scrollTop + clientHeight >= scrollHeight - 10;
        },
    },
    beforeUnmount() {
        this.stopPolling();
        this.$refs.messageContainer?.removeEventListener(
            "scroll",
            this.handleScroll
        );
    },
};
</script>

<style scoped>
.icon-enter-active,
.icon-leave-active {
    transition: all 0.3s ease;
}
.icon-enter-from,
.icon-leave-to {
    opacity: 0;
    transform: rotate(180deg);
}
</style>
