<template>
  <main class="d-flex align-items-center mx-0 h-100">
    <div class="container">
      <div class="row w-100 mx-0 justify-content-center">
<<<<<<< HEAD
        <b-card class="col-lg-7 col-xl-7 flex-row mx-auto px-0">
            <b-tabs v-model="tabIndex" card align="center">
              <b-tab class="tab1" title="Day">
                <div class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner text-center">
                    <div class="carousel-item active">
                      <h3>Friday</h3>
                      <span>Mar 23, 2021</span>
                    </div>
                    <div class="carousel-item">
                        <h3>Monday</h3>
                        <span>Mar 26, 2021</span>
                    </div>
                    <div class="carousel-item">
                        <h3>Tuesday</h3>
                        <span>Mar 27, 2021</span>
                    </div>
                  </div>
                  <a class="carousel-control-prev" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                <div class="mt-5 pt-3 form-input">
                  <span class="pt-3"><i class="fa fa-list" aria-hidden="true"></i></span>
                  <b-form-input
                    :state="null"
                    placeholder="Add a task..."
                    class="form-control"
                    type="text"
                    required
                  />
                </div>

                <div class="mb-3 row d-flex">

                  <div class="float-left pr-2">
                    <i class="fa fa-thumb-tack"></i>
                  </div>

                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cb3" name="">
                    <label class="custom-control-label" for="cb3">Finish Visual Design</label>
                    <br>
                    <span class="">One of my  goals in 2017</span>

                    <i class="align-middle" data-feather="more-vertical"></i>
                  </div>

                  <div class="ml-auto pr-3">
                      <b-icon icon="three-dots" class="three-dots" font-scale="2"></b-icon>
                  </div>
                </div>

                <hr class="mt-2">

                <div class="mb-3 row d-flex">

                  <div class="float-left pr-2 d-none">
                    <i class="fa fa-thumb-tack"></i>
                  </div>

                  <div class="custom-control custom-checkbox ml-4">
                    <input type="checkbox" class="custom-control-input" id="cb2" name="">
                    <label class="custom-control-label" for="cb2">Finish Visual Design</label>
                    <br>
                    <span class="">One of my  goals in 2017</span>

                    <i class="align-middle" data-feather="more-vertical"></i>
                  </div>

                  <div class="ml-auto pr-3">
                      <b-icon icon="three-dots" class="three-dots" font-scale="2"></b-icon>
                  </div>
                </div>

                <div class="mb-3 row d-flex">

                  <div class="float-left pr-2">
                    <i class="fa fa-thumb-tack"></i>
                  </div>

                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cb1" name="">
                    <label class="custom-control-label" for="cb1">Finish Visual Design</label>
                    <br>
                    <span class="">One of my  goals in 2017</span>

                    <i class="align-middle" data-feather="more-vertical"></i>
                  </div>

                  <div class="ml-auto pr-3">
                      <b-icon icon="three-dots" class="three-dots" font-scale="2"></b-icon>
                  </div>
                </div>



              </b-tab>
              <b-tab title="Week">
                <week-view />
              </b-tab>
            </b-tabs>
            <div class="card-body">
              <slot />
            </div>
        </b-card>
=======
        <slot />
>>>>>>> develop
      </div>
    </div>
  </main>
</template>
<script>
<<<<<<< HEAD

import { WeekView } from "@/components/Week";
export default {
  name: "DashWrap",
  components: {WeekView},
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

<style scoped>
  .carousel-item h3{
    color: #ccd7e2;
  }
  .carousel-item span{
    color: #6f757e;
=======
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
>>>>>>> develop
  }

  .carousel-control-prev-icon, .carousel-control-next{
    color: #6f757e;
  }

  .form-input{
    position: relative;
<<<<<<< HEAD
  }

  .form-input input{
    width: 100%;
    height: 42px;
    padding-left: 40px;
    margin-bottom: 20px;
    height: 42px;
    border-radius: 5px;
    border: 2px solid #2e3238;
    background-color: #343a40;
  }
  .form-input span{
    position: absolute;
    top: 10px;
    padding-left: 15px;
    color: #6f757e;
=======

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
>>>>>>> develop
  }
  .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before{
    color: white !important;
  }

  .custom-checkbox .custom-control-input ~ .custom-control-label::before{
    border-radius: 2px;
    border: 1px solid #2e3238;
    background-color: #6f757e;
<<<<<<< HEAD
  }

  .custom-control-label{

    color: #ccd7e2;
    padding-left: 20px;
  }

=======

  }

  .custom-checkbox{
    .custom-control-input{
      padding-right: 100px;
    }

    .custom-control-label{

      color: #ccd7e2;
    }

    
  }

  

>>>>>>> develop
  .custom-checkbox span{
    padding-left: 20px;
    color: #6f757e;
    font-size: 12px;
<<<<<<< HEAD
  }

  .fa-thumb-tack{
    color: #e55c8a;
    transform: rotate(315deg);
  }

  .three-dots{
      width: 18px;
      color: #ccd7e2;
=======
    width: 100%;
    display: block;

  }

  .fa-thumb-tack{
    transform: rotate(315deg);
  }

  .pinned{
    color: #e55c8a;
>>>>>>> develop
  }
</style>