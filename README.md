# rheingold
Psycho-Stochastic Opera / Computer Virus Music / Artificial Intelligence. (Command line) PHP 7 (with PECL stats) generates Csound CSD files. Cryptographically strong seeds of random number generator and functions. Source Wave file is Wagner: "Das Rheingold" - Thielemann (Bayreuth 2007)[1]. Based on models first developed in the Wiener Process (2010-2014)[2] and in Beethoven No.9 (2015)[3]. 

The work of rheingold was done after I rewrote the rothkamm.com site from ColdFusion to PHP. rothkamm.com archives and streams all of my works as MP3 sound files, JPEG images, ASCII texts and PDF documents across devices. I worked with ColdFusion artistically and professionally for close to 2 decades, but it was not an open source language, lacked direct support for statistics packages and was essentially another way to do Java. Generally, I abhor language verbosity, object orientation as a dictat and the monstrosity of the virtual machine. PHP, now with a command line interpreter, seemed more in line with the UNIX paradigm of “Do One Thing and Do It Well”. It was open source from the beginning and had a huge knowledge base on the web. String handling and the display of strings in the source code are excellent. This was needed, because what I wrote is essentially a meta-language. PHP generates Csound CSD files, which are “executed” by the Csound Engine and transformed into sound files or live sound. PHP also provides (via PECC) a statistics package and cryptographically strong random functions. It is well suited to do all tasks, from web over bash to math. In rheingold I also used for the first time git and github for source control and live publishing for the entire life cycle of the project. Although Github was intended for software products I used it to publish an art project in its entirety, open source and in real-time. I am deeply indebted to everyone who contributed to the underpinning infrastructure and tools. Thank you. Thank you very much.

To hear the music of "rheingold" in real-time: 

1.  You need git and csound installed (http://csound.com/download.html). 

Open Terminal:

> git clone https://github.com/fellowcraft/rheingold.git

> cd rheingold

> csound -odac CSD/act0.csd

> csound -odac CSD/act1.csd

> csound -odac CSD/act2.csd

> csound -odac CSD/act3.csd

> csound -odac CSD/act4.csd

This will play the latest version of all four acts plus Vorspiel.





Frank http://Rothkamm.com 

[1] https://www.youtube.com/watch?v=IHptIIbbXz4
[2] http://baskaru.com/karu33.htm
[3] http://rothkamm.com/album.php?Beethoven+No.9
