git add .
echo "Enter a commit message"
read MESSAGE
git commit -m MESSAGE
git push origin master
echo "Pushing"
