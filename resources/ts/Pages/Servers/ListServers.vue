<script setup lang="ts">
import DefaultLayout from "@/layouts/default-layout/DefaultLayout.vue";
import type {ListServersViewModel} from "@/types/generated";
import {router, useForm} from "@inertiajs/vue3";
import Swal from "sweetalert2";
import {ref} from "vue";
import CreateAppModal from "@/components/modals/wizards/CreateAppModal.vue";

const props = defineProps<ListServersViewModel>();

const deleteForm = useForm({});
const selectedServer = ref(null);
const loading = ref<number | null>(null);

const deleteServer = (serverId: number) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            loading.value = serverId;
            deleteForm.delete(route("servers.destroy", {id: serverId}), {
                onFinish: () => {
                    loading.value = null;
                    Swal.fire("Deleted!", "Your server has been deleted.", "success");
                },
                onError: () => {
                    loading.value = null;
                    Swal.fire("Error!", "Something went wrong. Try again.", "error");
                }
            });
        }
    });
};

const openCreateModal = () => {
    selectedServer.value = null;
};

const openEditModal = (server) => {
    selectedServer.value = server;
};

</script>

<template>
    <CreateAppModal :server="selectedServer"></CreateAppModal>
    <DefaultLayout>
        <div class="container py-4">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Serveur List</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gx-9 gy-6">
                        <div class="col-xl-6">
                            <div
                                class="notice d-flex bg-light-primary rounded border-primary border border-dashed flex-stack h-xl-100 mb-10 p-6">
                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                    <div class="mb-3 mb-md-0 fw-semibold">
                                        <h4 class="text-gray-900 fw-bold">Server Management</h4>
                                        <div class="fs-6 text-gray-700 pe-7">
                                            Easily create and manage your servers.
                                        </div>
                                    </div>
                                    <button @click="openCreateModal"
                                            data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_app"
                                            class="btn btn-primary px-6 align-self-center text-nowrap">
                                        Create new Server
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6" v-for="server in props.servers" :key="server.id">
                            <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                <div class="d-flex flex-column py-2">
                                    <div class="d-flex align-items-center fs-5 fw-bold mb-5">
                                        {{ server.name }}
                                        <span class="badge badge-light-success fs-7 ms-2">online</span>
                                    </div>
                                    <div class="fs-6 fw-semibold text-gray-600">
                                        {{ server.host }}
                                        <br>
                                        {{ server.description }}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center py-2">
                                    <button class="btn btn-sm btn-light btn-active-light-primary me-3"
                                            @click="deleteServer(server.id)" :disabled="loading === server.id">
                                        <span v-if="loading !== server.id">Delete</span>
                                        <span v-else>
                                            <span class="spinner-border spinner-border-sm align-middle"></span>
                                            Deleting...
                                        </span>
                                    </button>
                                    <button class="btn btn-sm btn-light btn-active-light-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_app"
                                            @click="openEditModal(server)">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
