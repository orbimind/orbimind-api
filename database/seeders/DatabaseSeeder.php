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
        // $this->seedPosts(DB::table('posts'));           // Seeding 5 posts
        // $this->seedComments(DB::table('comments'));     // Seeding 10 comments
        // $this->seedLikes(DB::table('likes'));           // Seeding 18 likes
    }

    protected function seedUsers($users)
    {
        $users->insert([
            'username' => "PAXANDDOS",
            'name' => "Paul",
            'email' => "pashalitovka" . '@gmail.com',
            'role' => "admin",
            'password' => Hash::make("paxanddos"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $users->insert([
            'username' => "VeyronRaze",
            'name' => "Pasha",
            'email' => "veyronraze" . '@gmail.com',
            'password' => Hash::make("paxanddos"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $users->insert([
            'username' => "Gazaris",
            'name' => "Artem",
            'email' => "afterlife.limbo" . '@gmail.com',
            'password' => Hash::make("paxanddos"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $users->insert([
            'username' => "Naztar",
            'name' => "Nazar",
            'email' => "nazar.taran.id" . '@gmail.com',
            'password' => Hash::make("paxanddos"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $users->insert([
            'username' => "Overwolf94",
            'name' => "Dima",
            'email' => "ytisnewlife" . '@gmail.com',
            'password' => Hash::make("paxanddos"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    protected function seedCategories($categories)
    {
        $categories->insert([
            'title' => "HTML",
            'description' => "The HyperText Markup Language, or HTML is the standard markup language for documents designed to be displayed in a web browser.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "CSS",
            'description' => "Cascading Style Sheets (CSS) is a style sheet language used for describing the presentation of a document written in a markup language such as HTML.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "JavaScript",
            'description' => "JavaScrip is a programming language that conforms to the ECMAScript specification..",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "PHP",
            'description' => "PHP is a general-purpose scripting language especially suited to web development.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Node.js",
            'description' => "Node.js is an open-source, cross-platform, back-end JavaScript runtime environment that
            runs on the V8 engine and executes JavaScript code outside a web browser.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "React",
            'description' => "React is a front end JavaScript library for building user interfaces or UI components. It is maintained by Facebook and
            a community of individual developers and companies.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "SQL",
            'description' => "SQL is a domain-specific language used in programming and designed for managing data held in a relational database management system (RDBMS),
            or for stream processing in a relational data stream management system (RDSMS).",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Laravel",
            'description' => "Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for
            the development of web applications following the model–view–controller (MVC) architectural pattern and based on Symfony.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Sass",
            'description' => "Sass (short for syntactically awesome style sheets) is a preprocessor scripting language that
            is interpreted or compiled into Cascading Style Sheets (CSS). SassScript is the scripting language itself.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "API",
            'description' => "The application programming interface (API) is an interface that defines interactions between multiple software applications or
            mixed hardware-software intermediaries.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "C#",
            'description' => "C# is a general-purpose, multi-paradigm programming language encompassing static typing, strong typing, lexically scoped, imperative, declarative, functional, generic, object-oriented, and component-oriented programming disciplines.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Python",
            'description' => "Python is an interpreted high-level general-purpose programming language. Python's design philosophy emphasizes code readability with its notable use of significant indentation.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Pascal",
            'description' => "Pascal is an imperative and procedural programming language, designed by Niklaus Wirth as a small, efficient language intended to encourage good programming practices using structured programming and data structuring.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Assembler",
            'description' => "In computer programming, assembly language, often abbreviated asm, is any low-level programming language in which there is a very strong correspondence between the instructions in the language and the architecture's machine code instructions.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Ruby",
            'description' => "Ruby is an interpreted, high-level, general-purpose programming language. It was designed and developed in the mid-1990s by Yukihiro 'Matz' Matsumoto in Japan. Ruby is dynamically typed and uses garbage collection and just-in-time compilation.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Perl",
            'description' => "Perl is a family of two high-level, general-purpose, interpreted, dynamic programming languages. 'Perl' refers to Perl 5, but from 2000 to 2019 it also referred to its redesigned 'sister language', Perl 6.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "GIMP ToolKit",
            'description' => "GTK is a free and open-source cross-platform widget toolkit for creating graphical user interfaces. It is licensed under the terms of the GNU Lesser General Public License, allowing both free and proprietary software to use it.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Simple DirectMedie Layer",
            'description' => "Simple DirectMedia Layer is a cross-platform software development library designed to provide a hardware abstraction layer for computer multimedia hardware components.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Vue",
            'description' => "Vue.js is an open-source model–view–viewmodel front end JavaScript framework for building user interfaces and single-page applications. It was created by Evan You, and is maintained by him and the rest of the active core team members.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Angular",
            'description' => "Angular is a TypeScript-based open-source web application framework led by the Angular Team at Google and by a community of individuals and corporations. Angular is a complete rewrite from the same team that built AngularJS.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Android",
            'description' => "Android is a mobile operating system based on a modified version of the Linux kernel and other open source software, designed primarily for touchscreen mobile devices such as smartphones and tablets.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "C",
            'description' => "C is a general-purpose, procedural computer programming language supporting structured programming, lexical variable scope, and recursion, with a static type system. By design, C provides constructs that map efficiently to typical machine instructions.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => ".NET",
            'description' => "The .NET Framework is a software framework developed by Microsoft that runs primarily on Microsoft Windows. It includes a large class library called Framework Class Library and provides language interoperability across several programming languages.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Regex",
            'description' => "A regular expression is a sequence of characters that specifies a search pattern. Usually such patterns are used by string-searching algorithms for 'find' or 'find and replace' operations on strings, or for input validation.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Rust",
            'description' => "Rust is a multi-paradigm programming language designed for performance and safety, especially safe concurrency. Rust is syntactically similar to C++, but can guarantee memory safety by using a borrow checker to validate references.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Front-end",
            'description' => "Front-end web development is the practice of converting data to a graphical interface, through the use of HTML, CSS, and JavaScript, so that users can view and interact with that data.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Back-end",
            'description' => "In the computer world, the 'backend' refers to any part of a website or software program that users do not see. It contrasts with the frontend, which refers to a program's or website's user interface.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Unity3D",
            'description' => "Unity is a cross-platform game engine developed by Unity Technologies, first announced and released in June 2005 at Apple Inc.'s Worldwide Developers Conference as a Mac OS X-exclusive game engine.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Furry",
            'description' => "Yo you found a secret!",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Heroku",
            'description' => "Heroku is a cloud platform as a service supporting several programming languages. One of the first cloud platforms, Heroku has been in development since June 2007, now it supports Java, Node.js, Scala, Clojure, Python, PHP, and Go.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "GitHub",
            'description' => "GitHub, Inc. is a provider of Internet hosting for software development and version control using Git. It offers the distributed version control and source code management functionality of Git, plus its own features.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "SVG",
            'description' => "Scalable Vector Graphics is an Extensible Markup Language-based vector image format for two-dimensional graphics with support for interactivity and animation.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Java",
            'description' => "Java is a high-level, class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categories->insert([
            'title' => "Cookie",
            'description' => "An HTTP cookie is a small piece of data stored on the user's computer by the web browser while browsing a website. Cookies were designed to be a reliable mechanism for websites to remember stateful information or to record the user's browsing activity.",
            'created_at' => now(),
            'updated_at' => now()
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
