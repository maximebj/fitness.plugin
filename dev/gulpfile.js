const gulp = require("gulp")
const stylus = require("gulp-stylus")
const autoprefixer = require("gulp-autoprefixer")
const plumber = require("gulp-plumber")

const bs = require("browser-sync").create() // create a browser sync instance.

// gulp.task("browser-sync", function() {
//   bs.init({
//     proxy: "http://fitness-planning.dev",
//     ghostMode: false,
//     open: false,
//     notify: false
//   })
// })

gulp.task("stylus-public-css", function() {
  return gulp
    .src("./stylus/fitness-planning-admin.styl")
    .pipe(plumber())
    .pipe(
      stylus({
        compress: true
      })
    )
    .pipe(autoprefixer({ browsers: ["last 2 versions"] }))
    .pipe(gulp.dest("../admin/css"))
    .pipe(bs.reload({ stream: true }))
})

gulp.task("stylus-admin-css", function() {
  return gulp
    .src("./stylus/fitness-planning-public.styl")
    .pipe(plumber())
    .pipe(
      stylus({
        compress: true
      })
    )
    .pipe(autoprefixer({ browsers: ["last 2 versions"] }))
    .pipe(gulp.dest("../public/css"))
    .pipe(bs.reload({ stream: true }))
})

// gulp.task("watch", ["browser-sync"], function() {
//   gulp.watch("./stylus/**/*.styl", ["stylus-public-css", "stylus-admin-css"])
//   gulp.watch("../*.php").on("change", bs.reload)
//   gulp.watch("../**/*.php").on("change", bs.reload)
//   gulp.watch("../**/*.js").on("change", bs.reload)
// })

gulp.task("watch", function() {
  gulp.watch("./stylus/**/*.styl", ["stylus-public-css", "stylus-admin-css"])
})
