<template>
  <div>
    <BannerComponent></BannerComponent>
    
    <section class="posts">
      <div class="container py-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
          <div
            class="col mb-3"
            v-for="post in postsResponse.data"
            :key="post.id"
          >
            <div class="product card">
              <img :src="'storage/' + post.cover_image" :alt="post.title" />
              <div class="card-body">
                <h3>{{ post.title }}</h3>
                <p>{{ post.content }}</p>
              </div>
              <div class="card-footer">
                <div class="col">
                  <div class="author">
                    <h4>Author:</h4>
                    <p>L'autore al momento non c'è</p>
                  </div>
                </div>
                <span v-if="post.category">
                  <strong>Category:</strong>
                  {{ post.category.name }}
                  <div class="tags" v-if="post.tags.length > 0">
                    <strong>Tags:</strong>
                    <ul>
                      <li v-for="tag in post.tags" :key="tag.id">
                        {{ tag.name }}
                      </li>
                    </ul>
                  </div>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center py-4">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <li class="page-item" v-if="postsResponse.current_page > 1">
                <a
                  class="page-link"
                  href="#"
                  aria-label="Previous"
                  @click.prevent="getAllPosts(postsResponse.current_page - 1)"
                >
                  <span aria-hidden="true">&laquo;</span>
                  <span class="">Previous</span>
                </a>
              </li>

              <li
                :class="{
                  'page-item': true,
                  active: page == postsResponse.current_page,
                }"
                v-for="page in postsResponse.last_page"
                :key="page.id"
              >
                <a class="page-link" href="#" @click.prevent="getPosts(page)">{{
                  page
                }}</a>
              </li>

              <li
                class="page-item"
                v-if="postsResponse.current_page < postsResponse.last_page"
              >
                <a
                  class="page-link"
                  href="#"
                  aria-label="Next"
                  @click.prevent="getAllPosts(postsResponse.current_page + 1)"
                >
                  <span class="">Next</span>
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import BannerComponent from '../components/BannerComponent'

export default {
  name: "App",
  components: {BannerComponent},
  data() {
    return {
      posts: "",
      postsResponse: "",
    };
  },
  methods: {
    getAllPosts(postPage) {
      axios
        .get("/api/posts", {
          params: {
            page: postPage,
          },
        })
        .then((response) => {
          console.log(response);
          this.postsResponse = response.data;
        })
        .catch((e) => {
          console.error(e);
        });
    },
  },
  mounted() {
    this.getAllPosts(1);
  },
};
</script>