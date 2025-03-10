<template>
    <div
        class="modal fade"
        id="kt_modal_create_app"
        tabindex="-1"
        aria-hidden="true"
        ref="modalRef"
    >
        <div class="modal-dialog modal-dialog-centered mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Create Server</h2>
                    <div
                        class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal"
                    >
                        <KTIcon icon-name="cross" icon-class="fs-1"/>
                    </div>
                </div>
                <div class="modal-body py-lg-10 px-lg-10">
                    <form id="kt_modal_new_target_form" @submit.prevent="createServer"
                          class="form fv-plugins-bootstrap5 fv-plugins-framework"
                          action="#">
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Server name</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter server name"
                                   name="name" v-model="form.name">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                {{ form.errors.name }}
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Host</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter server host"
                                   name="host" v-model="form.host">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                {{ form.errors.host }}
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-semibold mb-2">Description</label>
                            <textarea class="form-control form-control-solid" rows="3" name="description"
                                      v-model="form.description"
                                      placeholder="Type server description"></textarea>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                {{ form.errors.description }}
                            </div>
                        </div>
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <label class="required fs-6 fw-semibold mb-2">Installed OS</label>
                            <select class="form-select form-select-solid" name="installed_os"
                                    v-model="form.installed_os">
                                <option value="ubuntu">Ubuntu</option>
                                <option value="centos">CentOs</option>
                            </select>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                {{ form.errors.installed_os }}
                            </div>
                        </div>
                        <div class="d-flex flex-stack mb-8 mt-6">
                            <div class="me-5">
                                <label class="fs-6 fw-semibold">Agent installation</label>
                                <div class="fs-7 fw-semibold text-muted">
                                    By checking this option the app will automatically connect to the server <br> over
                                    ssh and install the agent
                                </div>
                            </div>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" v-model="form.auto_agent_install">
                                <span class="form-check-label fw-semibold text-muted">
                                Automatic
                            </span>
                            </label>
                        </div>

                        <div v-if="form.auto_agent_install">
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                    <label class="required fs-6 fw-semibold mb-2">Login Type</label>
                                    <select class="form-select form-select-solid" name="ssh_login_type"
                                            v-model="form.ssh_login_type">
                                        <option value="password">Password</option>
                                        <option value="ssh_private_key">SSH key</option>
                                    </select>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ form.errors.ssh_login_type }}
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">SSH user</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="Enter server ssh user"
                                           name="ssh_user" v-model="form.ssh_user">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ form.errors.ssh_user }}
                                    </div>
                                </div>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">SSH port</span>
                                    </label>
                                    <input type="number" class="form-control form-control-solid"
                                           placeholder="Enter server ssh port"
                                           name="ssh_port" v-model="form.ssh_port">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ form.errors.ssh_port }}
                                    </div>
                                </div>

                                <div class="col-md-6 fv-row fv-plugins-icon-container"
                                     v-if="form.ssh_login_type == 'password'">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">SSH password</span>
                                    </label>
                                    <input type="password" class="form-control form-control-solid"
                                           placeholder="Enter server ssh password"
                                           name="ssh_password" v-model="form.ssh_password">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ form.errors.ssh_password }}
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row fv-plugins-icon-container" v-else>
                                    <label class="required fs-6 fw-semibold mb-2">SSH private key</label>
                                    <textarea class="form-control form-control-solid" rows="3" name="ssh_private_key"
                                              v-model="form.ssh_private_key"
                                              placeholder="Enter SSH private key"></textarea>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ form.errors.ssh_private_key }}
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button class="btn"
                                            type="button"
                                            @click="testConnectivity"
                                            :class="form.connectivity_check ? 'btn-light-success': 'btn-light-warning'">
                                        Test SSH connectivity
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row g-9 mb-8" v-else>
                            <div class="col-md-12 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span>Instruction to follow for manual agent Instalation</span>
                                </label>
                                <code class="bg-dark text-white p-3 w-100 d-block" v-if="form.installed_os == 'ubuntu'">
                                    # SSH Instruction<br>
                                    # First, connect to your server with a sudo user<br>
                                    curl -o 'https://sec-monitoring.com/agent.sh'<br>
                                    sudo chmod -x agent.sh<br>
                                    sudo agent.sh<br>
                                </code>
                                <code class="bg-dark text-white p-3 w-100 d-block" v-if="form.installed_os == 'centos'">
                                    # SSH Instruction<br>
                                    # First, connect to your server with a sudo user<br>
                                    curl -o 'https://sec-monitoring.com/agent.sh'<br>
                                    sudo chmod -x agent.sh<br>
                                    sudo agent.sh<br>
                                </code>
                            </div>
                        </div>
                        <button class="btn btn-light-primary float-end"
                                :disabled="form.auto_agent_install && !form.connectivity_check">
                            Save Server
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {hideModal} from "@/core/helpers/modal";
import {ref} from "vue";
import {useForm, usePage, router} from "@inertiajs/vue3";
import Swal from "sweetalert2";
import {boolean} from "yup";

const modalRef = ref<HTMLElement | null>(null);
const page = usePage()
const props = defineProps<{
    server?: {
        name?: string;
        host?: string;
        description?: string;
        installed_os?: string;
        auto_agent_install?: boolean;
        ssh_login_type?: string;
        ssh_user?: string;
        ssh_port?: string | number;
        ssh_password?: string;
        ssh_private_key?: string;
    };
}>();

const form = useForm({
    name: props.server?.name ?? '',
    host: props.server?.host ?? '',
    description: props.server?.description ?? '',
    installed_os: props.server?.installed_os ?? 'ubuntu',
    auto_agent_install: props.server?.auto_agent_install ?? true,
    ssh_login_type: props.server?.ssh_login_type ?? 'password',
    ssh_user: props.server?.ssh_user ?? '',
    ssh_port: props.server?.ssh_port ?? '',
    ssh_password: props.server?.ssh_password ?? '',
    ssh_private_key: props.server?.ssh_private_key ?? '',
    connectivity_check: null,
});

const testConnectivity = () => {
    router.get(route('servers.test-ssh-connectivity'), form.data(), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (response) => {
            if (page.props.flash.error) {
                form.connectivity_check = false
                Swal.fire("Error!", "Please check the ssh credential.", "error");
            }
            if (page.props.flash.success) {
                form.connectivity_check = true
                Swal.fire("Checked!", "The SSH connectivity checked with success.", "success");
            }
            console.log(page.props.flash);
        }
    });
}

const createServer = () => {
    form.post(route('servers.store'), {
        onSuccess: () => {
            form.reset();
            closeModal()
            Swal.fire("Created!", "Your server has been created.", "success");
        },
        onError: () => {
            Swal.fire("Error!", "Something went wrong. Try again.", "error");
        }
    });
};

const closeModal = () => {
    form.reset();
};
</script>
