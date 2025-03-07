<script setup lang="ts">
import DefaultLayout from "@/layouts/default-layout/DefaultLayout.vue";
import type { ListServersViewModel } from "@/types/generated";
import { router } from '@inertiajs/vue3';

const props = defineProps<ListServersViewModel>();

// Add logic here if you need to handle adding a new server
const goToAddServerPage = () => {
    router.visit(route('servers.create')); // Navigate to add server page
};
</script>

<template>
    <DefaultLayout>
        <div class="container py-4">
            <h1 class="text-center mb-4">Liste des Serveurs</h1>
            <div class="row">
                <!-- Add New Server Card -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title text-center">Ajouter un Nouveau Serveur</h5>
                            <button
                                class="btn btn-primary mt-3"
                                @click="goToAddServerPage"
                            >
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Existing Server Cards -->
                <div
                    v-for="server in props.servers"
                    :key="server.id"
                    class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4"
                >
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ server.name }}</h5>
                            <p class="card-text"><strong>Hôte:</strong> {{ server.host }}</p>

                            <p class="card-text"><strong>Description:</strong> {{ server.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

