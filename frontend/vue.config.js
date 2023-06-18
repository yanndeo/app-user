const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  configureWebpack: {
    entry: "./src/main.js",
    devServer: {
      hot: true,
      // port: 8082, // CHANGE YOUR PORT HERE!
    },
    // watch: true,
    watchOptions: {
      ignored: /node_modules/,
      poll: 1000,
    },
  },
  transpileDependencies: true,
});
