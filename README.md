# bloggy
a simple content management system built using PHP, MySQL and JWT based authentication system.

API routes : 

#### 1) Login API : https://dev.rajkumaar.co.in/bloggy/api/signin.php  
POST username => <your_username>, password => <your_password>

#### 2) SIGN UP API : https://dev.rajkumaar.co.in/bloggy/api/signup.php  
POST  name => <your_name> ,username => <your_username>, password=> <your_password>

#### 3) VIEW POSTS API : https://dev.rajkumaar.co.in/bloggy/api/posts.php  
GET 
Header : 'Authorization'=>'Bearer <token_here>'  

#### 4) ADD POST API : https://dev.rajkumaar.co.in/bloggy/api/add.php  
POST title => <your_post_title>, content => <your_content>  
Header : 'Authorization'=>'Bearer <token_here>'  
	  
	  (Token will be present in successful response of LOGIN API)