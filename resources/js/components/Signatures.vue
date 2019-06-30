<template>
  <div>
    <div class="max-w-sm w-full lg:max-w-full lg:flex" v-for="signature in signatures">
      <div
        class="w-full border border-gray-400 lg:border lg:border-gray-400 bg-white rounded-b lg:rounded p-4 mb-4 flex flex-col justify-between leading-normal"
      >
        <div class="flex items-center">
          <img class="w-10 h-10 rounded-full mr-4" :src="signature.avatar" :alt="signature.name" />
          <div class="text-sm">
            <p class="text-gray-900 leading-none">{{ signature.name }}</p>
            <p class="text-gray-600">{{ signature.date }}</p>
          </div>
        </div>
        <div class="mx-4">
          <p class="text-gray-700 text-base my-2">{{ signature.body }}</p>
          <a
            href="#"
            id="comments"
            @click="report(signature.id)"
            class="text-sm text-gray-600 flex items-center"
          >
            <svg
              class="fill-current text-gray-500 w-3 h-3 mr-2"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path
                d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"
              />
            </svg>
            Report
          </a>
        </div>
      </div>
    </div>
    <paginate
      :page-count="pageCount"
      :click-handler="fetch"
      :prev-text="'Prev'"
      :next-text="'Next'"
      :container-class="'flex flex-row'"
      :active-class="'text-teal-500'"
      :page-class="'mr-3'"
      :prev-class="'mr-3'"
      :next-class="'mr-3'"
    ></paginate>
  </div>
</template>

<script>
export default {
  data() {
    return {
      signatures: [],
      pageCount: 1,
      endpoint: "api/signatures?page="
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch(page = 1) {
      axios.get(this.endpoint + page).then(({ data }) => {
        this.signatures = data.data;
        this.pageCount = data.meta.last_page;
      });
    },

    report(id) {
      if (confirm("Are you sure you want to report this signature?")) {
        axios
          .put("api/signatures/" + id + "/report")
          .then(response => this.removeSignature(id));
      }
    },

    removeSignature(id) {
      this.signatures = _.remove(this.signatures, function(signature) {
        return signature.id !== id;
      });
    }
  }
};
</script>