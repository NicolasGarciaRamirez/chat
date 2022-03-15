<template>
  <section class="relathions-ship" ref="ModalRelathions">
    <div
      class="modal fade"
      z-index="1050"
      role="dialog"
      aria-labelledby="ModalRelathions"
      aria-hidden="true"
      id="ModalRelathions"
    >
      <div class="modal-dialog modal-dialog modal-xl" role="document">
        <div class="modal-content modal-border-white bg-black p-3">
          <div class="justify-content-center">
            <div class="nav">
              <div>
                <a
                  :class="
                    type_table === 'Followers'
                      ? 'text-white font-weight-bold cursor-pointer active ml-2'
                      : 'text-white font-weight-bold cursor-pointer ml-2'
                  "
                  id="Followers-menu"
                  @click="(type_table = 'Followers'), getClassActive()"
                  >Followers</a
                >
                <a
                  :class="
                    type_table === 'Following'
                      ? 'text-white font-weight-bold cursor-pointer mx-4 active'
                      : 'text-white font-weight-bold cursor-pointer mx-4'
                  "
                  id="Following-menu"
                  @click="(type_table = 'Following'), getClassActive()"
                  >Following</a
                >
                <a
                  :class="
                    type_table === 'Supports'
                      ? 'text-white font-weight-bold cursor-pointer active'
                      : 'text-white font-weight-bold cursor-pointer'
                  "
                  id="Supports-menu"
                  @click="(type_table = 'Supports'), getClassActive()"
                  v-if="user.subscription_type === 'CONTRIBUTOR'"
                  >Supports</a
                >
                <a
                  :class="
                    type_table === 'Supporting'
                      ? 'text-white font-weight-bold cursor-pointer mx-4 active'
                      : 'text-white font-weight-bold cursor-pointer mx-4'
                  "
                  id="Supporting-menu"
                  @click="(type_table = 'Supporting'), getClassActive()"
                  v-if="user.subscription_type === 'CONTRIBUTOR'"
                  >Supporting</a
                >
                <a
                  :class="
                    type_table === 'Rewards'
                      ? 'text-white font-weight-bold cursor-pointer active'
                      : 'text-white font-weight-bold cursor-pointer'
                  "
                  id="Rewards-menu"
                  @click="(type_table = 'Rewards'), getClassActive()"
                  v-if="user.subscription_type === 'CONTRIBUTOR'"
                  >Rewards</a
                >
                <a
                  :class="
                    type_table === 'Rewarding'
                      ? 'text-white font-weight-bold cursor-pointer mx-4 active'
                      : 'text-white font-weight-bold cursor-pointer mx-4'
                  "
                  id="Rewarding-menu"
                  @click="(type_table = 'Rewarding'), getClassActive()"
                  v-if="user.subscription_type === 'CONTRIBUTOR'"
                  >Rewarded</a
                >
              </div>
            </div>
            <div class="d-flex flex-row my-4">
              <label class="m-2 font-weight-bold"
                >{{ type_table }} {{ array ? array.length : "0" }}</label
              >
              <form action="/" class="form-search ml-1">
                <div class="form-group m-0">
                  <div class="input-group">
                    <input
                      class="form-control pl-3"
                      type="text"
                      :placeholder="'Search through' + ' ' + type_table + '...'"
                      autocomplete="none"
                    />
                    <div
                      class="
                        d-flex
                        align-items-center
                        d-md-down-none
                        icons-search
                      "
                    >
                      <div class="divider-vertical mx-2"></div>
                      <svg
                        version="1.1"
                        id="Capa_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px"
                        y="0px"
                        width="17px"
                        viewBox="0 0 1078.387 1080"
                        enable-background="new 0 0 1078.387 1080"
                        xml:space="preserve"
                      >
                        <path
                          fill="#545454"
                          d="M798.209,701.259c53.341-73.104,85.239-162.767,85.239-260.073c0-243.442-197.52-441.594-440.232-441.594 C200.428-0.408,2.912,197.743,2.912,441.186c0,243.584,197.516,441.594,440.304,441.594c96.966,0,186.461-31.987,259.221-85.488 l288.434,289.301l95.771-96.104L798.209,701.259z M443.216,746.904c-168.083,0-304.792-137.148-304.792-305.719 s136.709-305.719,304.792-305.719c168.009,0,304.792,137.148,304.792,305.719S611.226,746.904,443.216,746.904"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="table-responsive">
              <table
                class="
                  table table-borderless table-striped
                  bg-black
                  text-center text-white text-justify
                  table-relathions
                "
              >
                <single-follower
                  :class="index % 2 === 0 ? 'bg-primary' : ''"
                  v-for="(user, index) in array"
                  :key="index"
                  :user="user"
                  :type_table="'Followers'"
                  v-if="array.length > 0 && type_table === 'Followers'"
                />
                <single-following
                  :class="index % 2 === 0 ? 'bg-primary' : ''"
                  v-for="(user, index) in array"
                  :key="index"
                  :user="user"
                  :type_table="'Following'"
                  v-if="array.length > 0 && type_table === 'Following'"
                />
                <single-supporting
                  :class="index % 2 === 0 ? 'bg-primary' : ''"
                  v-for="(supporting, index) in array"
                  :key="index"
                  :supporting="supporting"
                  :type_table="'Supporting'"
                  v-if="
                    array.length > 0 &&
                    type_table === 'Supporting' &&
                    user.subscription_type === 'CONTRIBUTOR'
                  "
                />
                <single-supports
                  :class="index % 2 === 0 ? 'bg-primary' : ''"
                  v-for="(support, index) in array"
                  :key="index"
                  :support="support"
                  :type_table="'Supports'"
                  v-if="
                    array.length > 0 &&
                    type_table === 'Supports' &&
                    user.subscription_type === 'CONTRIBUTOR'
                  "
                />
                <single-rewarding
                  :class="index % 2 === 0 ? 'bg-primary' : ''"
                  v-for="(rewarded, index) in array"
                  :key="index"
                  :rewarded="rewarded"
                  :type_table="'Rewarding'"
                  v-if="
                    array.length > 0 &&
                    type_table === 'Rewarding' &&
                    user.subscription_type === 'CONTRIBUTOR'
                  "
                />
                <single-rewards
                  :class="index % 2 === 0 ? 'bg-primary' : ''"
                  v-for="(reward, index) in array"
                  :key="index"
                  :reward="reward"
                  :type_table="'Rewards'"
                  v-if="
                    array.length > 0 &&
                    type_table === 'Rewards' &&
                    user.subscription_type === 'CONTRIBUTOR'
                  "
                />
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import Auth from "../../../../../helpers/Auth";
import SingleFollower from "../Relathions/Followers/SingleFollower";
import SingleFollowing from "../Relathions/Following/SingleFollowing";
import SingleSupporting from "../Relathions/Supporting/Single-supporting";
import SingleSupports from "../Relathions/Supports/Single-supports";
import SingleRewarding from "../Relathions/Rewarding/Single-rewarding";
import SingleRewards from "../Relathions/Rewards/Single-rewards";

export default {
  components: {
    SingleRewards,
    SingleRewarding,
    SingleSupports,
    SingleSupporting,
    SingleFollowing,
    SingleFollower,
  },
  data() {
    return {
      type_table:
        window.location.href === `/${Auth.state.username}/Channel/Edit`
          ? this.$parent.type_table
          : "Following",
      follow_type: "follow",
      follow: {
        type: "",
      },
      followers: [],
      followings: [],
      supports: [],
      supportings: [],
      rewards: [],
      rewardings: [],
      user: "",
    };
  },
  mounted() {
    Auth.initialize();
    this.getClassActive();
    this.getUser();
    this.getFollowings();
  },
  computed: {
    array() {
      if (this.type_table === "Following") {
        return this.followings;
      } else if (this.type_table === "Followers") {
        return this.followers;
      } else if (
        this.type_table === "Supporting" &&
        this.user.subscription_type === "CONTRIBUTOR"
      ) {
        return this.supportings;
      } else if (
        this.type_table === "Supports" &&
        this.user.subscription_type === "CONTRIBUTOR"
      ) {
        return this.supports;
      } else if (
        this.type_table === "Rewards" &&
        this.user.subscription_type === "CONTRIBUTOR"
      ) {
        return this.rewards;
      } else if (
        this.type_table === "Rewarding" &&
        this.user.subscription_type === "CONTRIBUTOR"
      ) {
        return this.rewardings;
      }
    },
  },
  methods: {
    async getUser() {
      await axios
        .post(`/User/get/${Auth.state.username}`)
        .then((res) => {
          this.user = res.data.user;
          _.each(res.data.user.followers, (follow) => {
            this.followers.push(follow.user);
          });
          _.each(res.data.user.supports, (support) => {
            this.supports.push(support);
          });
          _.each(res.data.user.rewards, (reward) => {
            this.rewards.push(reward);
          });
        })
        .catch((err) => {
          Auth.keepLogged(err.response.status);
        });
    },
    async getFollowings() {
      await axios
        .post(`/User/get/followings/${Auth.state.username}`)
        .then((res) => {
          _.each(res.data.followings, (following) => {
            this.followings.push(following.following);
          });
          _.each(res.data.supportings, (supporting) => {
            this.supportings.push(supporting);
          });
          _.each(res.data.rewardings, (rewarding) => {
            this.rewardings.push(rewarding);
          });
        })
        .catch((err) => {
          Auth.keepLogged(err.response.status);
        });
    },
    getClassActive() {
      if (this.type_table === "Followers") {
        $("#Followers-menu").addClass("active").removeClass("text-white");
        $("#Following-menu").removeClass("active").addClass("text-white");
        $("#Supporting-menu").removeClass("active").addClass("text-white");
        $("#Supports-menu").removeClass("active").addClass("text-white");
        $("#Rewarding-menu").removeClass("active").addClass("text-white");
      }
      if (this.type_table === "Following") {
        $("#Following-menu").addClass("active").removeClass("text-white");
        $("#Followers-menu").removeClass("active").addClass("text-white");
        $("#Supporting-menu").removeClass("active").addClass("text-white");
        $("#Supports-menu").removeClass("active").addClass("text-white");
        $("#Rewarding-menu").removeClass("active").addClass("text-white");
        $("#Rewards-menu").removeClass("active").addClass("text-white");
      }
      if (this.type_table === "Supports") {
        $("#Supports-menu").addClass("active").removeClass("text-white");
        $("#Supporting-menu").removeClass("active").addClass("text-white");
        $("#Following-menu").removeClass("active").addClass("text-white");
        $("#Followers-menu").removeClass("active").addClass("text-white");
        $("#Rewarding-menu").removeClass("active").addClass("text-white");
        $("#Rewards-menu").removeClass("active").addClass("text-white");
      }
      if (this.type_table === "Supporting") {
        $("#Supporting-menu").addClass("active").removeClass("text-white");
        $("#Supports-menu").removeClass("active").addClass("text-white");
        $("#Following-menu").removeClass("active").addClass("text-white");
        $("#Followers-menu").removeClass("active").addClass("text-white");
        $("#Rewarding-menu").removeClass("active").addClass("text-white");
        $("#Rewards-menu").removeClass("active").addClass("text-white");
      }
      if (this.type_table === "Rewards") {
        $("#Rewards-menu").addClass("active").removeClass("text-white");
        $("#Rewarding-menu").removeClass("active").addClass("text-white");
        $("#Following-menu").removeClass("active").addClass("text-white");
        $("#Followers-menu").removeClass("active").addClass("text-white");
        $("#Supporting-menu").removeClass("active").addClass("text-white");
        $("#Supports-menu").removeClass("active").addClass("text-white");
      }
      if (this.type_table === "Rewarding") {
        $("#Rewarding-menu").addClass("active").removeClass("text-white");
        $("#Rewards-menu").removeClass("active").addClass("text-white");
        $("#Following-menu").removeClass("active").addClass("text-white");
        $("#Followers-menu").removeClass("active").addClass("text-white");
        $("#Supporting-menu").removeClass("active").addClass("text-white");
        $("#Supports-menu").removeClass("active").addClass("text-white");
      }
    },
  },
};
</script>
