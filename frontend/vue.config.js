const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  configureWebpack: {
    entry: "./src/main.js",
    devServer: {
      hot: true,
      // port: 8082, // CHANGE YOUR PORT HERE!
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Headers":
          "Origin, X-Requested-With, Content-Type, Accept",
      },
      proxy: "http://localhost/api",
    },

    // watch: true,
    watchOptions: {
      ignored: /node_modules/,
      poll: 1000,
    },
  },
  css: {
    loaderOptions: {
      sass: {
        additionalData: `
          @import "@/assets/scss/main";
        `,
      },
    },
  },
  transpileDependencies: true,
});
