<template>
  <section>
     <div class="modal fade post" tabindex="-1" role="dialog" aria-labelledby="ModalEditPrivacy" aria-hidden="true" id="ModalEditPrivacy">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content modal-border-white">
          <div class="modal-header border-0">
            <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="transform: translate(69pc)">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body border-0">
            <div class="text-center mb-3">
              <h3><b>Edit Exclusivity</b></h3>
            </div>
            <div class="dropdown dropdown-sm">
              <div
                class="dropdown-btn"
                id="dropdownEveryone"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <b> {{ post.privacy ? post.privacy : "Everyone" }} </b>
                <div class="icon">
                  <svg
                    version="1.1"
                    id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px"
                    y="0px"
                    viewBox="0 0 24 24"
                    style="enable-background: new 0 0 24 24"
                    xml:space="preserve"
                    class="ml-1"
                  >
                    <g id="Layer_2-2">
                      <path
                        d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"
                      />
                    </g>
                  </svg>
                </div>
              </div>
              <div class="dropdown-menu" aria-labelledby="dropdownEveryone">
                <div class="dropdown-item" @click="post.privacy = 'Everyone'">
                  Everyone
                </div>
                <div class="dropdown-item" @click="post.privacy = 'Followers'">
                  Followers Only
                </div>
                <div v-if="auth.username && user.channel_information">
                  <div
                    class="dropdown-item"
                    v-for="(tier, index) in user.channel_information.tiers"
                    :key="index"
                    @click="post.privacy = tier.name"
                  >
                    {{ tier.name }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <div class="text-right">
              <button
                type="button"
                class="btn rounded-pill text-white"
                data-dismiss="modal"
              >
                Cancel
              </button>
              <button
                type="button"
                @click="update"
                class="btn bg-fifth rounded-pill text-white"
              >
                Update
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Auth from "../../../helpers/Auth";

export default {
  name: "ModalEditPrivacy",
  props: ["post"],
  data() {
    return {
      auth: Auth.state,
    };
  },
  mounted() {
    Auth.initialize();
  },
  computed: {
    user() {
      return this.post.user;
    },
  },
  methods: {
    async update() {
      if (Auth.state.username) {
        await Auth.setSession();
        await axios
          .post(
            `/${Auth.state.username}/Post/update/${this.post.token}`,
            this.post
          )
          .then((res) => {
            if (res.data.updated) {
              this.$toasted.show("Exclusivity has been updated successfully!", {
                position: "bottom-right",
                duration: 4000,
                className: "notification",
                keepOnHover: true,
                action: {
                  text: "x",
                  onClick: (e, toast) => {
                    toast.goAway(0);
                  },
                },
              });
            }
          })
          .catch((err) => {
            Auth.keepLogged(err.response.status);
          });
      }
    },
  },
};
</script>
