<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import DefaultLayout from "@/layouts/default-layout/DefaultLayout.vue";

// Initialize the form with the necessary fields
const form = useForm({
    name: '',
    host: '',
    description: '',
    ssh_login_type: '',
    ssh_user: '',
    ssh_port: '',
    ssh_password: '',
    ssh_private_key: '',
});

// Handle form submission
const createServer = () => {
    form.post(route('servers.store'), {
        onFinish: () => {
            form.reset();
        }
    });
};
</script>

<template>
    <DefaultLayout>
        <div class="container py-4">
            <h1 class="text-center mb-4">Créer un Nouveau Serveur</h1>

            <!-- Form for creating server -->
            <form @submit.prevent="createServer">
                <!-- Company ID (hidden or as a dropdown if necessary) -->

                <!-- Server Name -->
                <div class="mb-3">
                    <label for="serverName" class="form-label">Nom du Serveur</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="form-control form-control-sm"
                        id="serverName"
                        required
                    />
                </div>

                <!-- Host -->
                <div class="mb-3">
                    <label for="serverHost" class="form-label">Host</label>
                    <input
                        v-model="form.host"
                        type="text"
                        class="form-control form-control-sm"
                        id="serverHost"
                        required
                    />
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="serverDescription" class="form-label">Description</label>
                    <textarea
                        v-model="form.description"
                        class="form-control form-control-sm"
                        id="serverDescription"
                        rows="3"
                    ></textarea>
                </div>

                <!-- SSH Login Type -->
                <div class="mb-3">
                    <label for="serverSshLoginType" class="form-label">SSH Login Type</label>
                    <input
                        v-model="form.ssh_login_type"
                        type="text"
                        class="form-control form-control-sm"
                        id="serverSshLoginType"
                    />
                </div>

                <!-- SSH User -->
                <div class="mb-3">
                    <label for="serverSshUser" class="form-label">SSH User</label>
                    <input
                        v-model="form.ssh_user"
                        type="text"
                        class="form-control form-control-sm"
                        id="serverSshUser"
                    />
                </div>

                <!-- SSH Port -->
                <div class="mb-3">
                    <label for="serverSshPort" class="form-label">SSH Port</label>
                    <input
                        v-model="form.ssh_port"
                        type="text"
                        class="form-control form-control-sm"
                        id="serverSshPort"
                    />
                </div>

                <!-- SSH Password -->
                <div class="mb-3">
                    <label for="serverSshPassword" class="form-label">SSH Password</label>
                    <input
                        v-model="form.ssh_password"
                        type="password"
                        class="form-control form-control-sm"
                        id="serverSshPassword"
                    />
                </div>

                <!-- SSH Private Key -->
                <div class="mb-3">
                    <label for="serverSshPrivateKey" class="form-label">SSH Private Key</label>
                    <input
                        v-model="form.ssh_private_key"
                        type="text"
                        class="form-control form-control-sm"
                        id="serverSshPrivateKey"
                    />
                </div>

                <button type="submit" class="btn btn-primary">Créer le Serveur</button>
            </form>
        </div>
    </DefaultLayout>
</template>

<style scoped>
/* You can add custom styles for the form if necessary */
</style>
