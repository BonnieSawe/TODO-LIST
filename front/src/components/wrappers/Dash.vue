<template>
  <main class="d-flex align-items-center mx-0 h-100">
    <div class="container">
      <div class="row w-100 mx-0 justify-content-center">
        <slot />
      </div>
    </div>
  </main>
</template>
<script>
  export default {
    name: "DashWrap",
    data() {
      return {
        links: [
          { text: "Day", pathName: "day" },
          { text: 'Week', pathName: 'week'},
        ],
        active: false,
        tabIndex: 0
      };
    },
    methods: {
      async logout() {
        await this.$store.dispatch("auth/logout");
        this.$router.push({ name: "login" });
      },
    },
  };
</script>

<style lang="scss">
  .carousel-item {
    h3{
        color: #ccd7e2;
      }
      span{
        color: #6f757e;
    }
  }

  .carousel-control-prev-icon, .carousel-control-next{
    color: #6f757e;
  }

  .form-input{
    position: relative;

    input{
      width: 100%;
      height: 42px;
      padding-left: 40px;
      margin-bottom: 20px;
      height: 42px;
      border-radius: 5px;
      border: 2px solid #2e3238;
      background-color: #343a40;
    }

    span{
      position: absolute;
      top: 10px;
      padding-left: 15px;
      color: #6f757e;
    }
  }
  .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before{
    color: white !important;
  }

  .custom-checkbox .custom-control-input ~ .custom-control-label::before{
    border-radius: 2px;
    border: 1px solid #2e3238;
    background-color: #6f757e;
  }

  .custom-control-label{

    color: #ccd7e2;
    padding-left: 20px;
  }

  .custom-checkbox span{
    padding-left: 20px;
    color: #6f757e;
    font-size: 12px;
  }

  .fa-thumb-tack{
    transform: rotate(315deg);
  }

  .pinned{
    color: #e55c8a;
  }
</style>