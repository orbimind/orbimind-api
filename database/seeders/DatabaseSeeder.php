<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->seedUsers(DB::table('users'));           // Seeding 3 users
        $this->seedCategories(DB::table('categories')); // Seeding 10 categories
        $this->seedPosts(DB::table('posts'));           // Seeding 5 posts
        $this->seedComments(DB::table('comments'));     // Seeding 10 comments
        $this->seedLikes(DB::table('likes'));           // Seeding 18 likes
    }

    protected function seedUsers($users)
    {
        $users->insert([
            'username' => "PAXANDDOS",
            'name' => "Paul",
            'email' => "pashalitovka" . '@gmail.com',
            'role' => "admin",
            'password' => Hash::make("paxanddos"),
        ]);
        $users->insert([
            'username' => "Grandmaz",
            'name' => "Sanya",
            'email' => "lyannoy.alexander" . '@gmail.com',
            'password' => Hash::make("paxanddos"),
        ]);
        $users->insert([
            'username' => "VeyronRaze",
            'name' => "Pasha",
            'email' => "veyronraze" . '@gmail.com',
            'password' => Hash::make("paxanddos"),
        ]);
    }

    protected function seedCategories($categories)
    {
        $categories->insert([
            'title' => "HTML",
            'description' => "The HyperText Markup Language, or HTML is the standard markup language for documents designed to be displayed in a web browser."
        ]);
        $categories->insert([
            'title' => "CSS",
            'description' => "Cascading Style Sheets (CSS) is a style sheet language used for describing the presentation of a document written in a markup language such as HTML."
        ]);
        $categories->insert([
            'title' => "JavaScript",
            'description' => "JavaScrip is a programming language that conforms to the ECMAScript specification.."
        ]);
        $categories->insert([
            'title' => "PHP",
            'description' => "PHP is a general-purpose scripting language especially suited to web development."
        ]);
        $categories->insert([
            'title' => "Node.js",
            'description' => "Node.js is an open-source, cross-platform, back-end JavaScript runtime environment that
            runs on the V8 engine and executes JavaScript code outside a web browser."
        ]);
        $categories->insert([
            'title' => "React",
            'description' => "React is a front end JavaScript library for building user interfaces or UI components. It is maintained by Facebook and
            a community of individual developers and companies."
        ]);
        $categories->insert([
            'title' => "SQL",
            'description' => "SQL is a domain-specific language used in programming and designed for managing data held in a relational database management system (RDBMS),
            or for stream processing in a relational data stream management system (RDSMS)."
        ]);
        $categories->insert([
            'title' => "Laravel",
            'description' => "Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for
             the development of web applications following the model–view–controller (MVC) architectural pattern and based on Symfony."
        ]);
        $categories->insert([
            'title' => "Sass",
            'description' => "Sass (short for syntactically awesome style sheets) is a preprocessor scripting language that
            is interpreted or compiled into Cascading Style Sheets (CSS). SassScript is the scripting language itself."
        ]);
        $categories->insert([
            'title' => "API",
            'description' => "The application programming interface (API) is an interface that defines interactions between multiple software applications or
            mixed hardware-software intermediaries."
        ]);
    }

    protected function seedPosts($posts)
    {
        $posts->insert([
            'user_id' => 1,
            'title' => "RegEx match open tags except XHTML self-contained tags",
            'content' => "I need to match all of these opening tags:
                <p>
                <a href=foo>
                But not these:
                <br />
                <hr class=foo />
                I came up with this and wanted to make sure I've got it right. I am only capturing the a-z.
                <([a-z]+) *[^/]*?>
                I believe it says:
                Find a less-than, then
                Find (and capture) a-z one or more times, then
                Find zero or more spaces, then
                Find any character zero or more times, greedy, except /, then
                Find a greater-than
                Do I have that right? And more importantly, what do you think?",
            'category_id' => json_encode([1])
        ]);
        $posts->insert([
            'user_id' => 1,
            'title' => "How do I remove the space between inline/inline-block elements?",
            'content' => "Given this HTML and CSS:
                span {
                    display:inline-block;
                    width:100px;
                    background-color:palevioletred;
                }
                <p>
                    <span> Foo </span>
                    <span> Bar </span>
                </p>
                I understand why this happens, and I also know that I could get rid of that space by removing the white-space between the SPAN elements in the HTML source code, like so:
                <p>
                    <span> Foo </span><span> Bar </span>
                </p>
                However, I was hoping for a CSS solution that doesn't require the HTML source code to be tampered with.
                But can this issue be solved with CSS alone?",
            'category_id' => json_encode([1, 2])
        ]);
        $posts->insert([
            'user_id' => 2,
            'title' => "How do I return the response from an asynchronous call?",
            'content' => "I have a function foo which makes an asynchronous request. How can I return the response/result from foo?
                I tried returning the value from the callback, as well as assigning the result to a local variable inside the function and returning that one, but none of those ways actually return the response (they all return undefined or whatever the initial value of the variable result is).",
            'category_id' => json_encode([1, 3])
        ]);
        $posts->insert([
            'user_id' => 1,
            'title' => "How can I prevent SQL injection in PHP?",
            'content' => "If user input is inserted without modification into an SQL query, then the application becomes vulnerable to SQL injection, like in the following example:
                mysql_query(INSERT INTO `table` (`column`) VALUES ('unsafe_variable'));
                That's because the user can input something like value'); DROP TABLE table;--, and the query becomes:
                INSERT INTO `table` (`column`) VALUES('value'); DROP TABLE table;--')
                What can be done to prevent this from happening?",
            'category_id' => json_encode([1, 4, 7])
        ]);
        $posts->insert([
            'user_id' => 2,
            'title' => "useState set method not reflecting change immediately",
            'content' => "I am trying to learn hooks and the useState method has made me confused.
                I am assigning an initial value to a state in the form of an array.
                The set method in useState is not working for me even with spread(...) or without spread operator.
                I have made an API on another PC that I am calling and fetching the data which I want to set into the state.",
            'category_id' => json_encode([1, 3, 6])
        ]);
    }

    protected function seedComments($comments)
    {
        $comments->insert([
            'user_id' => 1,
            'post_id' => 2,
            'content' => "You should do this and that ok good luck"
        ]);
        $comments->insert([
            'user_id' => 2,
            'post_id' => 2,
            'content' => "Cringe post"
        ]);
        $comments->insert([
            'user_id' => 2,
            'post_id' => 1,
            'content' => "Cringe post its obvious"
        ]);
        $comments->insert([
            'user_id' => 3,
            'post_id' => 3,
            'content' => "I have the same problem lol"
        ]);
        $comments->insert([
            'user_id' => 1,
            'post_id' => 5,
            'content' => "Do this and you would be good"
        ]);
        $comments->insert([
            'user_id' => 3,
            'post_id' => 4,
            'content' => "sample text"
        ]);
        $comments->insert([
            'user_id' => 2,
            'post_id' => 1,
            'content' => "русские буковки"
        ]);
        $comments->insert([
            'user_id' => 1,
            'post_id' => 5,
            'content' => "Молодец продолжай"
        ]);
        $comments->insert([
            'user_id' => 3,
            'post_id' => 4,
            'content' => "qwertyui"
        ]);
        $comments->insert([
            'user_id' => 2,
            'post_id' => 3,
            'content' => "Nice post"
        ]);
    }

    protected function seedLikes($likes)
    {
        $likes->insert([
            'user_id' => 1,
            'post_id' => 1,
            'type' => "like"
        ]);
        $likes->insert([
            'user_id' => 2,
            'post_id' => 1,
            'type' => "like"
        ]);
        $likes->insert([
            'user_id' => 3,
            'post_id' => 1,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 1,
            'post_id' => 2,
            'type' => "like"
        ]);
        $likes->insert([
            'user_id' => 2,
            'post_id' => 2,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 3,
            'post_id' => 2,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 1,
            'post_id' => 3,
            'type' => "like"
        ]);
        $likes->insert([
            'user_id' => 2,
            'post_id' => 3,
            'type' => "like"
        ]);
        $likes->insert([
            'user_id' => 3,
            'post_id' => 3,
            'type' => "like"
        ]);


        $likes->insert([
            'user_id' => 1,
            'comment_id' => 1,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 1,
            'comment_id' => 2,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 1,
            'comment_id' => 3,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 2,
            'comment_id' => 1,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 2,
            'comment_id' => 2,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 2,
            'comment_id' => 3,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 3,
            'comment_id' => 1,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 3,
            'comment_id' => 2,
            'type' => "dislike"
        ]);
        $likes->insert([
            'user_id' => 3,
            'comment_id' => 3,
            'type' => "dislike"
        ]);
    }
}
