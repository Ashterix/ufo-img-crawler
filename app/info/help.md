


*********************************************************************************
     __  __________    ______  ________  ________  ___ _      ____   _______
    / / / / __/ __ \  /  _/  |/  / ___/ / ___/ _ \/ _ | | /| / / /  / __/ _ \
   / /_/ / _// /_/ / _/ // /|_/ / (_ / / /__/ , _/ __ | |/ |/ / /__/ _// , _/
   \____/_/  \____/ /___/_/  /_/\___/  \___/_/|_/_/ |_|__/|__/____/___/_/|_|

        _                                                   _
       /_`_  _  _  ._  / _/|_  _  /_  _  _    _ _/_._  _   / `__     _
      ._//_//_'/_ //_|/  / /_//  // // //_/|//_|/ //_// / /_;//_//_//_/
        /                                                          /

*********************************************************************************
UFO IMG CRAWLER ver. 1.0.0-alpha1                             2015-07-24 22:20:39

About:
 This crawler is a test task for the company Innovation Group.
 Due to the fact that at the time of development, I have not had a lot of time had
 to sacrifice writing TTD.
 And so the same abandon optimization and load balancing.
 Thus, this version is not intended for crawler parsing sites with lots of pages.
 I found empirically that the optimal number of pages to him - 200 or less.

Usage:
 options [arguments]

Options:
 --help (-h)    Display this help message
 --url  (-u)    Send parameter url for start crawler

Setting
 Run "composer install", wait for the installation of dependencies.
 For the folder "reports" to install write permissions.

Result
 Parsing results are saved in "reports" in the form of html files. Since the job
 Knowledge involves testing back-end, I did not spend time on drawing valid html.