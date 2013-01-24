This branch is to test how can GitHub respond to pull requesting merges
that are of the following setup.


1. Your everyday usual master and topic branch setup.

                 D -- E       topic
                /
               /
    A -- B -- C               master


2. Merge commit merges topic into master.

                 D -- E       topic
                /      \
	       /        \
    A -- B -- C -------- F    master

3. But the developer of the topic branch does not pull from the remote,
and instead of creating a new topic branch from the merge commit, he/she
continues to develop into the previous topic.

                 D -- E ---- G -- H      topic
                /      \
	       /        \
    A -- B -- C -------- F               master

4. Question is, what do?

We test this here, live on GitHub.
