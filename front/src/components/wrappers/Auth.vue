<template>
  <main class="d-flex align-items-center mx-0 h-100">
    <div class="container">
      <div class="row w-100 mx-0 justify-content-center">
        <div class="col-lg-6 col-xl-6 card flex-row mx-auto px-0">
            <div class="card-body">
              <slot />
            </div>
        </div>
      </div>
    </div>
  </main>
</template>
<script>
export default {
  name: "AuthWrap",
};
</script>
