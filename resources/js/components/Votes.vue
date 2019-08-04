<template>
  <div class="text-center">
    <!-- upvote -->
    <button
      class="btn btn btn-white p-1"
      v-if="this.voteStatus == 'false' || this.voteStatus == 'null'"
      @click="handleUpvote"
    >
      <i class="fas fa-arrow-up"></i>
    </button>
    <button class="btn btn btn-white p-1" v-else @click="handleUpvote">
      <i class="text-primary fas fa-arrow-up"></i>
    </button>

    <!-- vote count -->
    <div class="votes">{{ this.voteCount }}</div>

    <!-- downvote -->
    <button
      class="btn btn btn-white p-1"
      v-if="this.voteStatus == 'true' || this.voteStatus == 'null'"
      @click="handleDownvote"
    >
      <i class="fas fa-arrow-down"></i>
    </button>
    <button class="btn btn btn-white p-1" v-else @click="handleDownvote">
      <i class="text-primary fas fa-arrow-down"></i>
    </button>
  </div>
</template>
 
<script>
export default {
  props: ["post-id", "votes", "user-signed-in", "users-vote"],
  data() {
    return {
      voteCount: this.votes,
      isSignedIn: this.userSignedIn,
      voteStatus: this.usersVote
    };
  },

  methods: {
    handleUpvote() {
      if (this.isSignedIn != 1) {
        return window.location.href = "/register";
      }

      if (this.voteStatus == "true") {
        this.voteStatus = "null";
        this.voteCount--;
      } else {
        if (this.voteStatus == "false") {
          this.voteCount = this.voteCount + 2;
        } else if (this.voteStatus == "null") {
          this.voteCount++;
        }
        this.voteStatus = "true";
      }

      // update db
      axios
        .post("/vote", {
          post_id: this.postId,
          vote_type: "upvote"
        })
        .then(response => {});
    },

    handleDownvote() {
      if (this.isSignedIn != 1) {
        return window.location.href = "/register";
      }

      if (this.voteStatus == "false") {
        this.voteStatus = "null";
        this.voteCount++;
      } else {
        if (this.voteStatus == "true") {
          this.voteCount = this.voteCount - 2;
        } else if (this.voteStatus == "null") {
          this.voteCount--;
        }
        this.voteStatus = "false";
      }

      // update db
      axios
        .post("/vote", {
          post_id: this.postId,
          vote_type: "downvote"
        })
        .then(response => {});
    },
  }
};
</script>