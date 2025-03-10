<template>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="w-lg-500px p-10">
            <form class="form w-100" @submit.prevent="submitForm">
                <div class="text-center mb-10">
                    <h1 class="text-gray-900 mb-3">Sign In</h1>
                </div>
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bold text-gray-900">Email</label>
                    <input
                        class="form-control form-control-lg form-control-solid"
                        type="email"
                        name="email"
                        v-model="form.email"
                    />
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <ErrorMessage name="email"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bold text-gray-900 fs-6 mb-0">Password</label>
                        <router-link to="/password-reset" class="link-primary fs-6 fw-bold">
                            Forgot Password ?
                        </router-link>
                    </div>
                    <input
                        class="form-control form-control-lg form-control-solid"
                        type="password"
                        name="password"
                        v-model="form.password"
                        autocomplete="off"
                    />
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <ErrorMessage name="password"/>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button
                        type="submit"
                        ref="submitButton"
                        id="kt_sign_in_submit"
                        class="btn btn-lg btn-primary w-100 mb-5"
                    >
                        <span class="indicator-label"> Continue </span>

                        <span class="indicator-progress">
                            Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useRouter } from "vue-router";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/vue3";
import {route} from "ziggy-js";

const store = useAuthStore();
const router = useRouter();
const form = useForm({
    email: "",
    password: "",
});
const submitButton = ref<HTMLButtonElement | null>(null);

const submitForm = async () => {
    form.post(route("login"), {
        onStart: () => {
            if (submitButton.value) {
                submitButton.value.disabled = true;
                submitButton.value.setAttribute("data-kt-indicator", "on");
            }
        },
        onSuccess: () => {
            Swal.fire({
                text: "You have successfully logged in!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                heightAuto: false,
                customClass: {
                    confirmButton: "btn fw-semibold btn-light-primary",
                },
            }).then(() => {
                router.push({ name: "dashboard" });
            });
        },
        onError: (errors) => {
            Swal.fire({
                text: errors?.email || errors?.password || "Login failed. Please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Try again!",
                heightAuto: false,
                customClass: {
                    confirmButton: "btn fw-semibold btn-light-danger",
                },
            });
        },
        onFinish: () => {
            if (submitButton.value) {
                submitButton.value.removeAttribute("data-kt-indicator");
                submitButton.value.disabled = false;
            }
        },
    });
};
</script>
