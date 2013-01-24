*merge_test*: This branch was to test how can GitHub respond to pull requesting merges
that are of the following setup.


1. Your everyday usual master and topic branch setup.
<pre>
                 D -- E       topic
                /
               /
    A -- B -- C               master
</pre>

2. Merge commit merges topic into master.
<pre>
                 D -- E       topic
                /      \
	           /        \
    A -- B -- C -------- F    master
</pre>

3. But the developer of the topic branch does not pull from the remote,
and instead of creating a new topic branch from the merge commit, he/she
continues to develop into the previous topic.
<pre>
                 D -- E ---- G -- H      topic
                /      \
	           /        \
    A -- B -- C -------- F               master
</pre>

4. Well... it will be integrated continously.
<pre>
                 D -- E ---- G -- H        topic
                /      \           \
	           /        \           \
    A -- B -- C -------- F --------- I     master
</pre>

> We test this here, live on GitHub.

The fact is that Git **rocks**. :)