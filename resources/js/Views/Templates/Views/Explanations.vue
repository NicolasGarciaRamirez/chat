<template>
  <div class="lds-ripple-content" v-if="!explanation.filter">
    <div>
      <img src="/images/hello.png" alt="" />
      <div class="lds-ripple">
        <div></div>
        <div></div>
      </div>
      <div
        class="lds-ripple-popup ml-3 animate__animated shadow"
        @click.prevent="saveExplanation('filter')"
      >
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
          @click.prevent="saveExplanation('filter')"
        >
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
        <h2>Filter Your Stream!!</h2>
        <p>
          Our feed page (a.k.a Stream Page) does <b>NOT</b> show you who you
          follow. Instead, it shows you all of the content on Noisesharks. This
          gives more exposure to our creators.
        </p>
        <div>
          Use the filters to customise your feed and browse what you like. Up
          vote and down vote any content to push it either up or down the
          stream.
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import AppFooter from "./Footer.vue";
import Auth from "../../../helpers/Auth";
import FilterPost from "../../../helpers/FilterPost";
import Followers from "../../../helpers/Followers";
import Explanation from "../../../helpers/Explanation";
export default {
  data() {
    return {
      auth: Auth.state,
    };
  },
  computed: {
    explanation() {
      Explanation.get(this.auth.username);
      Explanation.initialize();
      return Explanation.data
        ? Explanation.data
        : { filter: false, credit: false, menu: false };
    },
  },
  mounted() {
    Auth.initialize();
  },
  methods: {
    saveExplanation(data) {
      let explanation = {
        filter: data === "filter",
        menu: Explanation.data.menu,
        credit: Explanation.data.credit,
      };
      Explanation.set(explanation, Auth.state.username);
    },
  },
};
</script>
