# ufo-img-crawler
This CLI application.

### About
 This crawler is a test task for the company Innovation Group.
 Due to the fact that at the time of development, I have not had a lot of time had
 to sacrifice writing TTD.
 And so the same abandon optimization and load balancing.
 Thus, this version is not intended for crawler parsing sites with lots of pages.
 I found empirically that the optimal number of pages to him - 200 or less.

### Usage
 options [arguments]

### Options
 --help (-h)    Display this help message
 
 --url  (-u)    Send parameter url for start crawler

### Setting
 Run "composer install", wait for the installation of dependencies.
 For the folder "reports" to install write permissions.

### Result
 Parsing results are saved in "reports" in the form of html files. Since the job
 Knowledge involves testing back-end, I did not spend time on drawing valid html.
