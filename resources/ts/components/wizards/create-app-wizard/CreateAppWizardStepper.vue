<template>
  <div
    class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
    id="kt_modal_create_app_stepper"
    ref="createAppStepperRef"
  >
    <div
      class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px"
    >
      <div class="stepper-nav ps-lg-10">
        <div class="stepper-item current" data-kt-stepper-element="nav">
          <div class="stepper-wrapper">
            <div class="stepper-icon w-40px h-40px">
              <i class="stepper-check fas fa-check"></i>
              <span class="stepper-number">1</span>
            </div>
            <div class="stepper-label">
              <h3 class="stepper-title">Details</h3>
              <div class="stepper-desc">Name your Server</div>
            </div>
          </div>
          <div class="stepper-line h-40px"></div>
        </div>
        <div class="stepper-item" data-kt-stepper-element="nav">
          <div class="stepper-wrapper">
            <div class="stepper-icon w-40px h-40px">
              <i class="stepper-check fas fa-check"></i>
              <span class="stepper-number">2</span>
            </div>

            <div class="stepper-label">
              <h3 class="stepper-title">Frameworks</h3>

              <div class="stepper-desc">Define your app framework</div>
            </div>
          </div>
          <div class="stepper-line h-40px"></div>
        </div>
        <div class="stepper-item" data-kt-stepper-element="nav">
          <div class="stepper-wrapper">
            <div class="stepper-icon w-40px h-40px">
              <i class="stepper-check fas fa-check"></i>
              <span class="stepper-number">3</span>
            </div>
            <div class="stepper-label">
              <h3 class="stepper-title">Database</h3>

              <div class="stepper-desc">Select the app database type</div>
            </div>
          </div>
          <div class="stepper-line h-40px"></div>
        </div>

        <div class="stepper-item" data-kt-stepper-element="nav">
          <div class="stepper-wrapper">
            <div class="stepper-icon w-40px h-40px">
              <i class="stepper-check fas fa-check"></i>
              <span class="stepper-number">4</span>
            </div>
            <div class="stepper-label">
              <h3 class="stepper-title">Billing</h3>

              <div class="stepper-desc">Provide payment details</div>
            </div>
          </div>
          <div class="stepper-line h-40px"></div>
        </div>

        <div class="stepper-item" data-kt-stepper-element="nav">
          <div class="stepper-wrapper">
            <div class="stepper-icon w-40px h-40px">
              <i class="stepper-check fas fa-check"></i>
              <span class="stepper-number">5</span>
            </div>
            <div class="stepper-label">
              <h3 class="stepper-title">Release</h3>

              <div class="stepper-desc">Review and Submit</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex-row-fluid py-lg-5 px-lg-15">
      <CreateAppModalForm
        :stepperEl="createAppStepperRef"
        :close-hadler="props.closeHadler"
      />
      <!--end::Form-->
    </div>
    <!--end::Content-->
  </div>
  <!--end::Stepper-->
</template>

<script setup lang="ts">
import { ref } from "vue";
import CreateAppModalForm from "@/components/wizards/create-app-wizard/CreateAppWizardForm.vue";

interface Props {
  closeHadler?: () => void;
}

const props = defineProps<Props>();

const createAppStepperRef = ref<HTMLElement | null>(null);
</script>
