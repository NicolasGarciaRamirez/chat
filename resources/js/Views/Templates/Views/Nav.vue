<template>
  <ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-title sidebar-title-principal">
      Filter Your Stream
      <img src="/images/sharks-menu.svg" alt="" />
    </li>
    <li class="c-sidebar-nav-title pt-2">Genre</li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="pop">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Pop</b>
        <input
          type="checkbox"
          id="pop"
          @click="updateFilterGender('Pop')"
          data-genre="Pop"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Rap & Hip-hop">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Rap & Hip-hop</b>
        <input
          type="checkbox"
          id="Rap & Hip-hop"
          @click="updateFilterGender('Rap & Hip-hop')"
          data-genre="Rap & Hip-hop"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="EDM">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>EDM</b>
        <input
          type="checkbox"
          id="EDM"
          @click="updateFilterGender('EDM')"
          data-genre="EDM"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Rock & Metal">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Rock & Metal</b>
        <input
          type="checkbox"
          id="Rock & Metal"
          @click="updateFilterGender('Rock & Metal')"
          data-genre="Rock & Metal"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Jazz & Blues">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Jazz & Blues</b>
        <input
          type="checkbox"
          id="Jazz & Blues"
          @click="updateFilterGender('Jazz & Blues')"
          data-genre="Jazz & Blues"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Classical">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Classical</b>
        <input
          type="checkbox"
          id="Classical"
          @click="updateFilterGender('Classical')"
          data-genre="Classical"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Funk">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Funk</b>
        <input
          type="checkbox"
          id="Funk"
          @click="updateFilterGender('Funk')"
          data-genre="Funk"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="World">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>World</b>
        <input
          type="checkbox"
          id="World"
          @click="updateFilterGender('World')"
          data-genre="World"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="LoFi">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>LoFi</b>
        <input
          type="checkbox"
          id="LoFi"
          @click="updateFilterGender('LoFi')"
          data-genre="LoFi"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link mb-2" for="Not Specific">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Not Specific</b>
        <input
          type="checkbox"
          id="Not Specific"
          @click="updateFilterGender('Not Specific')"
          data-genre="Not Specific"
        />
        <span class="radio-button"></span>
      </label>
    </li>

    <li class="c-sidebar-nav-title">Topic</li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Talking Music!">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Talking Music</b>
        <input
          type="checkbox"
          id="Talking Music!"
          @click="updateFilterCategory('Talking Music!')"
          data-genre="Talking Music!"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Performances and Jams">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Performances and Jams</b>
        <input
          type="checkbox"
          id="Performances and Jams"
          @click="updateFilterCategory('Performances and Jams')"
          data-genre="Performances and Jams"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Production & Engineering">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Production & Engineering</b>
        <input
          type="checkbox"
          id="Production & Engineering"
          @click="updateFilterCategory('Production & Engineering')"
          data-genre="Production & Engineering"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Lessons and Tips">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Lessons & Tips</b>
        <input
          type="checkbox"
          id="Lessons and Tips"
          @click="updateFilterCategory('Lessons and Tips')"
          data-genre="Lessons and Tips"
        />
        <span class="radio-button"></span>
      </label>
    </li>

    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Vlogs">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Vlogs</b>
        <input
          type="checkbox"
          id="Vlogs"
          @click="updateFilterCategory('Vlogs')"
          data-genre="Vlogs"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Instruments/Gear">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Instruments & Gear</b>
        <input
          type="checkbox"
          id="Instruments/Gear"
          @click="updateFilterCategory('Instruments/Gear')"
          data-genre="Instruments/Gear"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Music Podcasts">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Music Podcasts</b>
        <input
          type="checkbox"
          id="Music Podcasts"
          @click="updateFilterCategory('Music Podcasts')"
          data-genre="Music Podcasts"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <label class="c-sidebar-nav-link" for="Releases">
        <i class="c-sidebar-nav-icon fas fa-comments-dollar"></i>
        <b>Releases</b>
        <input
          type="checkbox"
          id="Releases"
          @click="updateFilterCategory('Releases')"
          data-genre="Releases"
        />
        <span class="radio-button"></span>
      </label>
    </li>
    <li class="c-sidebar-nav-item">
      <div class="divider my-3 mx-auto"></div>
    </li>
    <li class="c-sidebar-nav-title mt-0">
      <div class="d-flex align-items-center">
        Following
        <svg
          class="ml-auto"
          style="margin-right: 12px"
          width="20"
          version="1.1"
          baseProfile="tiny"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          x="0px"
          y="0px"
          viewBox="0 0 24 24"
          xml:space="preserve"
        >
          <path
            d="M23,9.4C22.9,9.2,22.7,9,22.5,9l-6.8-1.1l-3.1-6.5C12.5,1.2,12.3,1,12,1c-0.2,0-0.5,0.1-0.6,0.4l-3,6.4 L1.6,8.9C1.3,9,1.1,9.1,1,9.4c0,0.2,0,0.5,0.2,0.6l4.9,5.1L5,22.3c0,0.2,0.1,0.5,0.3,0.6C5.4,23,5.5,23,5.7,23 c0.1,0,0.2,0,0.3-0.1l6.1-3.4l6.1,3.4c0.2,0.1,0.5,0.1,0.7,0c0.2-0.1,0.3-0.4,0.3-0.6L18,15.1l4.9-5.1C23,9.9,23,9.6,23,9.4z"
          />
        </svg>
      </div>
      <img src="/images/sharks-menu.svg" alt="" />
    </li>
    <div class="px-3" v-if="auth.username || location">
      <div v-for="(follow, index) in array" :key="index">
        <li
          class="c-sidebar-nav-item sidebar-nav-item-translatex-animation mb-2"
          v-if="follow.following.username"
        >
          <a
            :href="`/${follow.following.username}/Channel/Activity`"
            class="no-underline text-white font-weight-bold"
            >{{ follow.following.artistic_name }}
            <img
              src="/images/icons/check.svg"
              alt=""
              class="icon-check ml-1 icon-sm"
              v-if="follow.following.verification_date"
          /></a>
          <!-- <span class="float-right dot mb-2 "></span> -->
        </li>
      </div>
    </div>
    <app-footer />
  </ul>
</template>

<script>
import AppFooter from "./Footer.vue";
import Auth from "../../../helpers/Auth";
import FilterPost from "../../../helpers/FilterPost";
import Followers from "../../../helpers/Followers";
import Explanation from "../../../helpers/Explanation";
export default {
  props: ["following"],
  data() {
    return {
      auth: Auth.state,
      filters: FilterPost.state,
      location: false,
      followings: null,
    };
  },
  components: {
    AppFooter,
  },
  computed: {
    array() {
      if (!Auth.state.username) return [];

      if (this.followings === null) {
        return this.following.following;
      } else {
        return this.followings;
      }
    },
  },
  mounted() {
    Auth.initialize();
    FilterPost.initialize();
    this.setFilters();
  },
  methods: {
    updateFilterGender(genre) {
      FilterPost.removeOrAddGenres(genre);
      let data = FilterPost.jsonParseAttributes();
      if (FilterPost.deleted) {
        if (data.genres === null && data.categories === null) {
          this.$root.$refs.home.all_post = [];
          this.$root.$refs.home.getPosts();
        } else {
          this.filterPost();
        }
      } else {
        this.filterPost();
      }
    },
    updateFilterCategory(category) {
      FilterPost.removeOrAddCategories(category);
      let data = FilterPost.jsonParseAttributes();
      if (FilterPost.deleted) {
        if (data.categories === null && data.genres === null) {
          this.$root.$refs.home.all_post = [];
          this.$root.$refs.home.getPosts();
        } else {
          this.filterPost();
        }
      } else {
        this.filterPost();
      }
    },
    filterPost() {
      if (
        location.href === "http://localhost:8000/" ||
        location.href === "https://www.noisesharks.com/"
      ) {
        this.$root.$refs.home.filterPost();
      }
    },
    setFilters() {
      let genres = JSON.parse(FilterPost.state.genres);
      let categories = JSON.parse(FilterPost.state.categories);
      if (genres !== null) {
        genres.map(function (o) {
          $('*[data-genre="' + o + '"]').prop("checked", true);
        });
      }
      if (categories !== null) {
        categories.map(function (o) {
          $('*[data-category="' + o + '"]').prop("checked", true);
        });
      }

      if (genres !== null || categories !== null) {
        this.filterPost();
      } else {
      }
    },
  },
};
</script>
