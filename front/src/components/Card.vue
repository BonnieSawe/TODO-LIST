<template>
  <div class="card">
    <div v-if="title" class="card-header py-3">
      <slot name="header">
        <h5 class="mb-0">
          {{ title }}
        </h5>
      </slot>
    </div>

    <div class="card-body">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",

  props: {
    title: { type: String, default: null }
  }
};
</script>
