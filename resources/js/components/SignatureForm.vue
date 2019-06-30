<template>
  <div>
    <div
      v-if="saved"
      class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md rounded mb-4"
      role="alert"
    >
      <div class="flex">
        <div class="py-1">
          <svg
            class="fill-current h-6 w-6 text-teal-500 mr-4"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path
              d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
            />
          </svg>
        </div>
        <div>
          <p class="font-bold">Success!</p>
          <p class="text-sm">Your signature has been saved successfully.</p>
        </div>
      </div>
    </div>
    <div class="w-full" id="signature-form">
      <form
        method="post"
        @submit.prevent="onSubmit"
        class="bg-white shadow rounded px-8 pt-6 pb-8 mb-4"
      >
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            :class="{'border-red-500': errors.name}"
            v-model="signature.name"
            id="name"
            type="text"
            placeholder="Your name"
          />
          <p v-if="errors.name" class="text-red-500 text-xs italic">{{ errors.name[0] }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Your E-mail</label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            :class="{'border-red-500': errors.email}"
            v-model="signature.email"
            id="email"
            type="email"
            placeholder="Your email"
          />
          <p v-if="errors.email" class="text-red-500 text-xs italic">{{ errors.email[0] }}</p>
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="body">Your message</label>
          <textarea
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            :class="{'border-red-500': errors.body}"
            id="body"
            v-model="signature.body"
            placeholder="Please enter your message here..."
            rows="5"
          ></textarea>
          <p v-if="errors.body" class="text-red-500 text-xs italic">{{ errors.body[0] }}</p>
        </div>
        <div class="flex items-center justify-end">
          <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit"
          >Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errors: [],
      saved: false,
      signature: {
        name: null,
        email: null,
        body: null
      }
    };
  },

  methods: {
    onSubmit() {
      this.saved = false;

      axios
        .post("api/signatures", this.signature)
        .then(({ data }) => this.setSuccessMessage())
        .catch(({ response }) => this.setErrors(response));
    },

    setErrors(response) {
      this.errors = response.data.errors;
    },

    setSuccessMessage() {
      this.reset();
      this.saved = true;
    },

    reset() {
      this.errors = [];
      this.signature = { name: null, email: null, body: null };
    }
  }
};
</script>