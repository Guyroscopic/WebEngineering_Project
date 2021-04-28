-- Creating "lazylearn" Database
DROP DATABASE IF EXISTS lazylearn;
CREATE DATABASE lazylearn;

-- Using the Database
USE lazylearn;

-- Creating "student" Table
CREATE TABLE `lazylearn`.`student` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;
-- Adding Updated Columns
ALTER TABLE `lazylearn`.`student` 
ADD COLUMN `phone` VARCHAR(11) UNIQUE NOT NULL,
ADD COLUMN `cnic` VARCHAR(6) UNIQUE NOT NULL;

-- Creating "teacher" Table
CREATE TABLE `lazylearn`.`teacher` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `education` VARCHAR(1000) NULL , `description` VARCHAR(1000) NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;
-- Adding Updated Columns
ALTER TABLE `lazylearn`.`teacher` 
ADD COLUMN `phone` VARCHAR(11) UNIQUE NOT NULL,
ADD COLUMN `cnic` VARCHAR(6) UNIQUE NOT NULL;

-- Creating "admin" Table
CREATE TABLE `lazylearn`.`admin` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;

-- Creating "tutorial_catageory" Table
CREATE TABLE `lazylearn`.`tutorial_categeory` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "tutorial" Table
CREATE TABLE `lazylearn`.`tutorial` ( `id` INT NOT NULL AUTO_INCREMENT , `category_id` INT NOT NULL , `instructor` VARCHAR(100) NOT NULL , `title` VARCHAR(100) NOT NULL , `description` VARCHAR(1000) NOT NULL , `video` VARCHAR(100) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "paragraph" Table
CREATE TABLE `lazylearn`.`paragraph` ( `id` INT NOT NULL AUTO_INCREMENT , `tutorial_id` INT NOT NULL , `heading` VARCHAR(100) NOT NULL , `content` VARCHAR(5000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "quiz" Table
CREATE TABLE `lazylearn`.`quiz` ( `id` INT NOT NULL AUTO_INCREMENT , `tutorial_id` INT NOT NULL , `topic` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "question" Table
CREATE TABLE `lazylearn`.`question` ( `id` INT NOT NULL AUTO_INCREMENT , `quiz_id` INT NOT NULL , `statement` VARCHAR(1000) NOT NULL , `option1` VARCHAR(100) NOT NULL , `option2` VARCHAR(100) NOT NULL , `option3` VARCHAR(100) NULL , `option4` VARCHAR(100) NULL , `correct_option` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "student_tutorial_bridge" Table
CREATE TABLE `lazylearn`.`student_tutorial_bridge` ( `id` INT NOT NULL AUTO_INCREMENT , `student_email` VARCHAR(100) NOT NULL , `tutorial_id` INT NOT NULL , `tutorial_rating` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "student_quiz_bridge" Table
CREATE TABLE `lazylearn`.`student_quiz_bridge` ( `id` INT NOT NULL AUTO_INCREMENT , `student_email` VARCHAR(100) NOT NULL , `quiz_id` INT NOT NULL , `quiz_score` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Adding Foregin Key Reference from "tutorial" to "tutorial_catageory"
ALTER TABLE tutorial 
    ADD CONSTRAINT category_id_inTuorial
    FOREIGN KEY (category_id)
    REFERENCES tutorial_categeory(id)
    ON DELETE CASCADE;

-- Adding Foregin Key Reference from "tutorial" to "teacher"
ALTER TABLE tutorial 
    ADD CONSTRAINT instructor_inTuorial
    FOREIGN KEY (instructor)
    REFERENCES teacher(email)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "paragraph "to "tutorial"
ALTER TABLE paragraph
    ADD CONSTRAINT tutorial_id_inParagraph
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "quiz "to "tutorial"
ALTER TABLE quiz
    ADD CONSTRAINT tutorial_id_inQuiz
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "question "to "quiz"
ALTER TABLE question
    ADD CONSTRAINT quiz_id_inQuestion
    FOREIGN KEY (quiz_id)
    REFERENCES quiz(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_tutorial_bridge "to "student"
ALTER TABLE student_tutorial_bridge
    ADD CONSTRAINT student_email_inSTB
    FOREIGN KEY (student_email)
    REFERENCES student(email)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_tutorial_bridge "to "tutorial"
ALTER TABLE student_tutorial_bridge
    ADD CONSTRAINT tutorial_id_inSTB
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_quiz_bridge "to "student"
ALTER TABLE student_quiz_bridge
    ADD CONSTRAINT student_email_inSQB
    FOREIGN KEY (student_email)
    REFERENCES student(email)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_quiz_bridge "to "quiz"
ALTER TABLE student_quiz_bridge
    ADD CONSTRAINT quiz_id_inSQB
    FOREIGN KEY (quiz_id)
    REFERENCES quiz(id)
    ON DELETE CASCADE;

-- Populating "student" Table
INSERT INTO `student`(`email`, `username`, `password`, `phone`, `cnic`) VALUES ("rafey@example.com",   "Abdul Rafey",   "12345678", "03207047670", "567891");
INSERT INTO `student`(`email`, `username`, `password`, `phone`, `cnic`) VALUES ("laraib@example.com",  "Laraib Arjamand",  "12345678", "03207047671", "567892");
INSERT INTO `student`(`email`, `username`, `password`, `phone`, `cnic`) VALUES ("fatima@example.com",  "Fatima Khalid",  "12345678", "03207047672", "567893");
INSERT INTO `student`(`email`, `username`, `password`, `phone`, `cnic`) VALUES ("ghazala@example.com", "Ghazala Bibi", "12345678", "03207047673", "567894");

-- Populating "teacher" Table
INSERT INTO `teacher`(`email`, `username`, `password`, `education`, `description`, `phone`, `cnic`) VALUES ("qaiser@example.com", "Qaiser Riaz",     "12345678", "PhD in xyz, From abc University",   "I am a Professor at NUST, Islamabad, Pakistan. I teach Web Development to 2nd and 3rd Year Students.", "03207047671", "567891");
INSERT INTO `teacher`(`email`, `username`, `password`, `education`, `description`, `phone`, `cnic`) VALUES ("tofeeq@example.com", "Tofeq ur Rehman", "12345678", "PhD in qwe, From def University",   "I am a Professor at NUST, Islamabad, Pakistan. I teach Computer Organization and Operating Systems to 2nd and 3rd Year Students.", "03207047672", "567892");
INSERT INTO `teacher`(`email`, `username`, `password`, `education`, `description`, `phone`, `cnic`) VALUES ("hammad@example.com", "Hammad Ahmed",    "12345678", "MS in pop, From qwerty University", "I am a Professor at NUST, Islamabad, Pakistan. I teach Machine Learning to 2nd and 3rd Year Students.", "03207047673", "567893");

-- Populating "admin" Table
INSERT INTO `admin`(`email`, `username`, `password`) VALUES ('admin1@example.com', 'Admin 1', '12345678');
INSERT INTO `admin`(`email`, `username`, `password`) VALUES ('admin2@example.com', 'Admin 2', '12345678');

-- Populating "tutorial_catageory" Table
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Programming");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Maths");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Arts");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("English");

-- Populating "tutorial" Table
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`, `video`) VALUES (1, 'qaiser@example.com', 'Python',             'In this tutorial we will have a bried overview of Python', '../assets/videos/videoForTutorial_1.mp4');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`, `video`) VALUES (1, 'qaiser@example.com','JavaScript Features', 'In this tutorial we will have a bried overview of JavaScript Features', '../assets/videos/videoForTutorial_2.mp4');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, 'qaiser@example.com', 'C++',                'In this tutorial we will have a bried overview of C++');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, 'qaiser@example.com', 'Java Program Struture', 'In this tutorial we will have a bried overview of Java Program Structure' );
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, 'qaiser@example.com', 'C Data Types',          'In this tutorial we will have a bried overview of C Data Types');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`, `video`) VALUES (2, 'qaiser@example.com', 'Population and Sample Variance','Lets have fun with Ratios and Variance!!', '../assets/videos/videoForTutorial_6.mp4');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`, `video`) VALUES (2, 'qaiser@example.com', 'Quadratic Formula',  'The most important formula you need to know', '../assets/videos/videoForTutorial_7.mp4');

INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (2, 'tofeeq@example.com', 'Complex Numbers', 'In this tutorial we will learn about Complex Numbers and iota');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (2, 'qaiser@example.com', 'History Calculus', 'Newton invented Calculus and we will learn how he did it!');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (2, 'tofeeq@example.com', 'Linear Algebra Vector Spaces', 'Lets have a look on why Linear Algebra is the best branch of Maths');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`, `video`) VALUES (3, 'tofeeq@example.com', 'Drawing', 'Lets have a look at Drawing', '../assets/videos/videoForTutorial_11.mp4');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`, `video`) VALUES (3, 'tofeeq@example.com', 'Conceptual art', 'What is Conceptual Art?', '../assets/videos/videoForTutorial_12.mp4');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (3, 'tofeeq@example.com', 'Ceramics', 'How to make realistic looking Ceremic Sculptures');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (3, 'tofeeq@example.com', 'Painting', 'All you need to know about Painting');

INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (3, 'hammad@example.com', 'How to get started with Photography', 'In this tutorial we will learn about the basics of Photography');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`, `video`) VALUES (4, 'hammad@example.com', 'What are the parts of Speech?', 'In this tutorial we will look at all 8 Parts of Speech', '../assets/videos/videoForTutorial_16.mp4');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`, `video`) VALUES (4, 'hammad@example.com', 'How to use the Past Perfect Tense', 'Lets Learn about Past Perfect Tense', '../assets/videos/videoForTutorial_17.mp4');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (4, 'hammad@example.com', 'What are Gerunds', 'Gerunds are an important part of English Grammer, in this tutorial we will get familiarized with them' );
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (4, 'hammad@example.com', 'How to improve your Vocabulary', 'In this tutorial we will look on different techniques to make your vocab better');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (4, 'hammad@example.com', 'How to Change Direct Sentences to Indirect Sentences', 'Direct and Indirect Sentences');

-- Populating "paragraph" Table
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (1, 'History', 'Python was conceived in the late 1980s by Guido van Rossum at Centrum Wiskunde & Informatica (CWI) in the Netherlands as a successor to ABC programming language, which was inspired by SETL, capable of exception handling and interfacing with the Amoeba operating system. Its implementation began in December 1989. Van Rossum shouldered sole responsibility for the project, as the lead developer, until 12 July 2018, when he announced his "permanent vacation" from his responsibilities as Pythons Benevolent Dictator For Life, a title the Python community bestowed upon him to reflect his long-term commitment as the projects chief decision-maker. He now shares his leadership as a member of a five-person steering council. In January 2019, active Python core developers elected Brett Cannon, Nick Coghlan, Barry Warsaw, Carol Willing and Van Rossum to a five-member "Steering Council" to lead the project. Guido van Rossum has since then withdrawn his nomination for the 2020 Steering council.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (1, 'Indentation',  'Python uses whitespace indentation, rather than curly brackets or keywords, to delimit blocks. An increase in indentation comes after certain statements; a decrease in indentation signifies the end of the current block. Thus, the programs visual structure accurately represents the programs semantic structure. This feature is sometimes termed the off-side rule, which some other languages share, but in most languages indentation doesnt have any semantic meaning.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (1, 'Methods', 'Methods on objects are functions attached to the objects class; the syntax instance.method(argument) is, for normal methods and functions, syntactic sugar for Class.method(instance, argument). Python methods have an explicit self parameter to access instance data, in contrast to the implicit self (or this) in some other object-oriented programming languages (e.g., C++, Java, Objective-C, or Ruby).');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (2, 'Imperative and Structured', 'JavaScript supports much of the structured programming syntax from C (e.g., if statements, while loops, switch statements, do while loops, etc.). One partial exception is scoping: JavaScript originally had only function scoping with var. ECMAScript 2015 added keywords let and const for block scoping, meaning JavaScript now has both function and block scoping. Like C, JavaScript makes a distinction between expressions and statements. One syntactic difference from C is automatic semicolon insertion, which allows the semicolons that would normally terminate statements to be omitted.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (2, 'Functional', 'A function is first-class; a function is considered to be an object. As such, a function may have properties and methods, such as .call() and .bind(). A nested function is a function defined within another function. It is created each time the outer function is invoked. In addition, each nested function forms a lexical closure: The lexical scope of the outer function (including any constant, local variable, or argument value) becomes part of the internal state of each inner function object, even after execution of the outer function concludes. JavaScript also supports anonymous functions.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (3, 'C++ Core Guidelines', 'The C++ Core Guidelines are an initiative led by Bjarne Stroustrup, the inventor of C++, and Herb Sutter, the convener and chair of the C++ ISO Working Group, to help programmers write Modern C++ by using best practices for the language standards C++14 and newer, and to help developers of compilers and static checking tools to create rules for catching bad programming practices.\nThe main aim is to efficiently and consistently write type and resource safe C++.\nThe Core Guidelines were announced in the opening keynote at CPPCon 2015.\nThe Guidelines are accompanied by the Guideline Support Library (GSL), a header only library of types and functions to implement the Core Guidelines and static checker tools for enforcing Guideline rules');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (3, 'Compatibility', 'To give compiler vendors greater freedom, the C++ standards committee decided not to dictate the implementation of name mangling, exception handling, and other implementation-specific features. The downside of this decision is that object code produced by different compilers is expected to be incompatible. There were, however, attempts to standardize compilers for particular machines or operating systems (for example C++ ABI), though they seem to be largely abandoned now.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (3, 'Criticism', 'Despite its widespread adoption, some notable programmers have criticized the C++ language, including Linus Torvalds, Richard Stallman, Joshua Bloch, Ken Thompson, and Donald Knuth.\nOne of the most often criticised points of C++ is its perceived complexity as a language, with the criticism that a large number of non-orthogonal features in practice necessitates restricting code to subset of C++, thus eschewing the readability benefits of common style and idioms. As expressed by Joshua Bloch:\nI think C++ was pushed well beyond its complexity threshold, and yet there are a lot of people programming it. But what you do is you force people to subset it. So almost every shop that I know of that uses C++ says, "Yes, we are using C++ but we are not doing multiple-implementation inheritance and we are not using operator overloading." There are just a bunch of features that you are not going to use because the complexity of the resulting code is too high. And I do not think it is good when you have to start doing that. You lose this programmer portability where everyone can read everyone elses code, which I think is such a good thing.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (4, '"main" Method', 'Every Java application must have an entry point. This is true of both graphical interface applications and console applications. The entry point is the main method. There can be more than one class with a main method, but the main class is always defined externally (for example, in a manifest file). The method must be static and is passed command-line arguments as an array of strings. Unlike C++ or C#, it never returns a value and must return void.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (4, 'Packages', 'Packages are a part of a class name and they are used to group and/or distinguish named entities from other ones. Another purpose of packages is to govern code access together with access modifiers. For example, java.io.InputStream is a fully qualified class name for the class InputStream which is located in the package java.io. A package is declared at the start of the file with the package declaration');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (5, 'Pointers', 'C supports the use of pointers, a type of reference that records the address or location of an object or function in memory. Pointers can be dereferenced to access data stored at the address pointed to, or to invoke a pointed-to function. Pointers can be manipulated using assignment or pointer arithmetic. The run-time representation of a pointer value is typically a raw memory address (perhaps augmented by an offset-within-word field), but since a pointers type includes the type of the thing pointed to, expressions including pointers can be type-checked at compile time. Pointer arithmetic is automatically scaled by the size of the pointed-to data type. Pointers are used for many purposes in C. Text strings are commonly manipulated using pointers into arrays of characters. Dynamic memory allocation is performed using pointers. Many data types, such as trees, are commonly implemented as dynamically allocated struct objects linked together using pointers. Pointers to functions are useful for passing functions as arguments to higher-order functions (such as qsort or bsearch) or as callbacks to be invoked by event handlers');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (5, 'Arrays', 'Array types in C are traditionally of a fixed, static size specified at compile time. (The more recent C99 standard also allows a form of variable-length arrays.) However, it is also possible to allocate a block of memory (of arbitrary size) at run-time, using the standard librarys malloc function, and treat it as an array. Cs unification of arrays and pointers means that declared arrays and these dynamically allocated simulated arrays are virtually interchangeable. Since arrays are always accessed (in effect) via pointers, array accesses are typically not checked against the underlying array size, although some compilers may provide bounds checking as an option.[33][34] Array bounds violations are therefore possible and rather common in carelessly written code, and can lead to various repercussions, including illegal memory accesses, corruption of data, buffer overruns, and run-time exceptions. If bounds checking is desired, it must be done manually.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (6, 'Population Variance', 'Real-world observations such as the measurements of yesterdays rain throughout the day typically cannot be complete sets of all possible observations that could be made. As such, the variance calculated from the finite set will in general not match the variance that would have been calculated from the full population of possible observations. This means that one estimates the mean and variance that would have been calculated from an omniscient set of observations by using an estimator equation. The estimator is a function of the sample of n observations drawn without observational bias from the whole population of potential observations. In this example that sample would be the set of actual measurements of yesterdays rainfall from available rain gauges within the geography of interest.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (6, 'Sample Variance' , 'In many practical situations, the true variance of a population is not known a priori and must be computed somehow. When dealing with extremely large populations, it is not possible to count every object in the population, so the computation must be performed on a sample of the population.[9] Sample variance can also be applied to the estimation of the variance of a continuous distribution from a sample of that distribution.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (7, 'Historical Development', 'The earliest methods for solving quadratic equations were geometric. Babylonian cuneiform tablets contain problems reducible to solving quadratic equations. The Egyptian Berlin Papyrus, dating back to the Middle Kingdom (2050 BC to 1650 BC), contains the solution to a two-term quadratic equation. The Greek mathematician Euclid (circa 300 BC) used geometric methods to solve quadratic equations in Book 2 of his Elements, an influential mathematical treatise. Rules for quadratic equations appear in the Chinese The Nine Chapters on the Mathematical Art circa 200 BC. In his work Arithmetica, the Greek mathematician Diophantus (circa 250 AD) solved quadratic equations with a method more recognizably algebraic than the geometric algebra of Euclid. His solution gives only one root, even when both roots are positive. The Indian mathematician Brahmagupta (597 - 668 AD) explicitly described the quadratic formula in his treatise Brahmasphutasiddhanta published in 628 AD, but written in words instead of symbols. His solution of the quadratic equation ax2 + bx = c was as follows: "To the absolute number multiplied by four times the [coefficient of the] square, add the square of the [coefficient of the] middle term; the square root of the same, less the [coefficient of the] middle term, being divided by twice the [coefficient of the] square is the value."');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (8, 'Notation', 'A real number a can be regarded as a complex number a + 0i, whose imaginary part is 0. A purely imaginary number bi is a complex number 0 + bi, whose real part is zero. As with polynomials, it is common to write a for a + 0i and bi for 0 + bi. Moreover, when the imaginary part is negative, that is, b = -|b| < 0, it is common to write a - |b|i instead of a + (-|b|)i; for example, for b = -4, 3 - 4i can be written instead of 3 + (-4)i. Since the multiplication of the indeterminate i and a real is commutative in polynomials with real coefficients, the polynomial a + bi may be written as a + ib. This is often expedient for imaginary parts denoted by expressions, for example, when b is a radical');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (8, 'Definition', 'A complex number is a number of the form a + bi, where a and b are real numbers, and i is an indeterminate satisfying i2 = -1. For example, 2 + 3i is a complex number. This way, a complex number is defined as a polynomial with real coefficients in the single indeterminate i, for which the relation i2 + 1 = 0 is imposed. Based on this definition, complex numbers can be added and multiplied, using the addition and multiplication for polynomials. The relation i2 + 1 = 0 induces the equalities i4k = 1, i4k+1 = i, i4k+2 = -1, and i4k+3 = -i, which hold for all integers k; these allow the reduction of any polynomial that results from the addition and multiplication of complex numbers to a linear polynomial in i, again of the form a + bi with real coefficients a, b. The real number a is called the real part of the complex number a + bi; the real number b is called its imaginary part. To emphasize, the imaginary part does not include a factor i; that is, the imaginary part is b, not bi. Formally, the complex numbers are defined as the quotient ring of the polynomial ring in the indeterminate i, by the ideal generated by the polynomial i2 + 1');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (9, 'Ancient', 'The ancient period introduced some of the ideas that led to integral calculus, but does not seem to have developed these ideas in a rigorous and systematic way. Calculations of volumes and areas, one goal of integral calculus, can be found in the Egyptian Moscow papyrus (c. 1820 BC), but the formulas are only given for concrete numbers, some are only approximately true, and they are not derived by deductive reasoning. Babylonians may have discovered the trapezoidal rule while doing astronomical observations of Jupiter. From the age of Greek mathematics, Eudoxus (c. 408 - 355 BC) used the method of exhaustion, which foreshadows the concept of the limit, to calculate areas and volumes, while Archimedes (c. 287 - 212 BC) developed this idea further, inventing heuristics which resemble the methods of integral calculus.[4] Greek mathematicians are also credited with a significant use of infinitesimals. Democritus is the first person recorded to consider seriously the division of objects into an infinite number of cross-sections, but his inability to rationalize discrete cross-sections with a cones smooth slope prevented him from accepting the idea. At approximately the same time, Zeno of Elea discredited infinitesimals further by his articulation of the paradoxes which they create.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (9, 'Medieval', 'In the Islamic Middle East, the 11th-century Arab mathematician Ibn al-Haytham (Alhazen) derived a formula for the sum of fourth powers. He used the results to carry out what would now be called an integration, where the formulas for the sums of integral squares and fourth powers allowed him to calculate the volume of a paraboloid. In the 12th century, the Persian mathematician Sharaf al-Din al-Tusi discovered the derivative of cubic polynomials. His Treatise on Equations developed concepts related to differential calculus, such as the derivative function and the maxima and minima of curves, in order to solve cubic equations which may not have positive solutions. Some ideas on calculus later appeared in Indian mathematics, at the Kerala school of astronomy and mathematics. Madhava of Sangamagrama in the 14th century, and later mathematicians of the Kerala school, stated components of calculus such as the Taylor series and infinite series approximations. However, they were not able to combine many differing ideas under the two unifying themes of the derivative and the integral, show the connection between the two, and turn calculus into the powerful problem-solving tool we have today');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (10, 'Linear Maps', 'A bijective linear map between two vector spaces (that is, every vector from the second space is associated with exactly one in the first) is an isomorphism. Because an isomorphism preserves linear structure, two isomorphic vector spaces are "essentially the same" from the linear algebra point of view, in the sense that they cannot be distinguished by using vector space properties. An essential question in linear algebra is testing whether a linear map is an isomorphism or not, and, if it is not an isomorphism, finding its range (or image) and the set of elements that are mapped to the zero vector, called the kernel of the map. All these questions can be solved by using Gaussian elimination or some variant of this algorithm.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (10, 'Subspaces, span, and basis', 'The study of those subsets of vector spaces that are in themselves vector spaces under the induced operations is fundamental, similarly as for many mathematical structures. These subsets are called linear subspaces. More precisely, a linear subspace of a vector space V over a field F is a subset W of V such that u + v and au are in W, for every u, v in W, and every a in F. (These conditions suffice for implying that W is a vector space.)');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (10, 'Linear Systems', 'A finite set of linear equations in a finite set of variables, for example, x1,x2, ... xn or x,y, ... z is called a system of linear equations or a linear system. Systems of linear equations form a fundamental part of linear algebra. Historically, linear algebra and matrix theory has been developed for solving such systems. In the modern presentation of linear algebra through vector spaces and matrices, many problems may be interpreted in terms of linear systems.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (11, 'Introduction', 'Drawing is a means of making an image, using any of a wide variety of tools and techniques. It generally involves making marks on a surface by applying pressure from a tool, or moving a tool across a surface. Common tools are graphite pencils, pen and ink, inked brushes, wax colour pencils, crayons, charcoals, pastels, and markers. Digital tools which can simulate the effects of these are also used. The main techniques used in drawing are line drawing, hatching, crosshatching, random hatching, scribbling, stippling, and blending. An artist who excels in drawing is referred to as a drafter, draftswoman, or draughtsman. Drawing can be used to create art used in cultural industries such as illustrations, comics and animation. Comics are often called the "ninth art" (le neuvieme art) in Francophone scholarship, adding to the traditional "Seven Arts".');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (12, 'Introduction', 'Conceptual art is art in which the concept(s) or idea(s) involved in the work takes precedence over traditional aesthetic and material concerns. The inception of the term in the 1960s referred to a strict and focused practice of idea-based art that often defied traditional visual criteria associated with the visual arts in its presentation as text. Through its association with the Young British Artists and the Turner Prize during the 1990s, its popular usage, particularly in the United Kingdom, developed as a synonym for all contemporary art that does not practise the traditional skills of painting and sculpture.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (13, 'Introduction', 'Ceramic art is art made from ceramic materials (including clay), which may take forms such as pottery, tile, figurines, sculpture, and tableware. While some ceramic products are considered fine art, some are considered to be decorative, industrial, or applied art objects. Ceramics may also be considered artefacts in archaeology. Ceramic art can be made by one person or by a group of people. In a pottery or ceramic factory, a group of people design, manufacture, and decorate the pottery. Products from a pottery are sometimes referred to as "art pottery." In a one-person pottery studio, ceramists or potters produce studio pottery. In modern ceramic engineering usage, "ceramics" is the art and science of making objects from inorganic, non-metallic materials by the action of heat. It excludes glass and mosaic made from glass tesserae.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (14, 'Introduction', 'Painting is a mode of creative expression, and can be done in numerous forms. Drawing, gesture (as in gestural painting), composition, narration (as in narrative art), or abstraction (as in abstract art), among other aesthetic modes, may serve to manifest the expressive and conceptual intention of the practitioner. Paintings can be naturalistic and representational (as in a still life or landscape painting), photographic, abstract, narrative, symbolistic (as in Symbolist art), emotive (as in Expressionism), or political in nature (as in Artivism). Modern painters have extended the practice considerably to include, for example, collage. Collage is not painting in the strict sense since it includes other materials. Some modern painters incorporate different materials such as sand, cement, straw, wood or strands of hair for their artwork texture. Examples of this are the works of Elito Circa, Jean Dubuffet or Anselm Kiefer.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (15, 'Introduction', 'PPhotography as an art form refers to photographs that are created in accordance with the creative vision of the photographer. Art photography stands in contrast to photojournalism, which provides a visual account for news events, and commercial photography, the primary focus of which is to advertise products or services.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (16, 'Noun', 'A noun is a word for a person, place, thing, or idea. Nouns are often used with an article (the, a, an), but not always. Proper nouns always start with a capital letter; common nouns do not. Nouns can be singular or plural, concrete or abstract. Nouns show possession by addings. Nouns can function in different roles within a sentence; for example, a noun can be a subject, direct object, indirect object, subject complement, or object of a preposition.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (16, 'Pronoun', 'A pronoun is a word used in place of a noun. A pronoun is usually substituted for a specific noun, which is called its antecedent. In the sentence above, the antecedent for the pronoun she is the girl. Pronouns are further defined by type: personal pronouns refer to specific persons or things; possessive pronouns indicate ownership; reflexive pronouns are used to emphasize another noun or pronoun; relative pronouns introduce a subordinate clause; and demonstrative pronouns identify, point to, or refer to nouns.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (16, 'Verb', 'The verb in a sentence expresses action or being. There is a main verb and sometimes one or more helping verbs. ("She can sing." Sing is the main verb; can is the helping verb.) A verb must agree with its subject in number (both are singular or both are plural). Verbs also take different forms to express tense.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (16, 'Adjective', 'An adjective is a word used to modify or describe a noun or a pronoun. It usually answers the question of which one, what kind, or how many. (Articles [a, an, the] are usually classified as adjectives.)');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (16, 'Adverb', 'An adverb describes or modifies a verb, an adjective, or another adverb, but never a noun. It usually answers the questions of when, where, how, why, under what conditions, or to what degree. Adverbs often end in -ly.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (16, 'Conjunction', 'A conjunction joins words, phrases, or clauses, and indicates the relationship between the elements joined. Coordinating conjunctions connect grammatically equal elements: and, but, or, nor, for, so, yet. Subordinating conjunctions connect clauses that are not equal: because, although, while, since, etc. There are other types of conjunctions as well.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (16, 'Interjection', 'An interjection is a word used to express emotion. It is often followed by an exclamation point.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (16, 'Preposition', 'A preposition is a word placed before a noun or pronoun to form a phrase modifying another word in the sentence. Therefore a preposition is always part of a prepositional phrase. The prepositional phrase almost always functions as an adjective or as an adverb. ');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (17, 'The Past Perfect Formula', 'The formula for the past perfect tense is had + [past participle]. It does not matter if the subject is singular or plural; the formula does not change.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (17, 'When to Use the Past Perfect', 'So what is the difference between past perfect and simple past? When you are talking about some point in the past and want to reference an event that happened even earlier, using the past perfect allows you to convey the sequence of the events. It is also clearer and more specific');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (17, 'When Not to Use the Past Perfect', 'Do not use the past perfect when you are not trying to convey some sequence of events. If your friends asked what you did after you discovered the graffiti, they would be confused if you said: I had cleaned it off the door. They would likely be wondering what happened next because using the past perfect implies that your action of cleaning the door occurred before something else happened, but you do not say what that something else is. The "something else" does not always have to be explicitly mentioned, but context needs to make it clear. In this case there is no context, so the past perfect does not make sense.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (18, 'What is a Gerund Phrase?', 'A gerund phrase is a phrase consisting of a gerund and any modifiers or objects associated with it. A gerund is a noun made from a verb root plus ing (a present participle). A whole gerund phrase functions in a sentence just like a noun, and can act as a subject, an object, or a predicate nominative.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (18, 'How Do Gerund Phrases Work? They Act Like a Noun', 'Gerunds can appear alone or band together with other words to form a gerund phrase. Collectively, this phrase behaves like a single noun. Example: Running is a favorite activity of mine. Example: Running with scissors is a favorite activity of mine. Both the gerund and the gerund phrase above function as subject nouns and take the third-person singular verb is. We could substitute a non-gerund noun such as chess to mentally confirm its function. Example: Chess is a favorite activity of mine.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (18, 'Not Acting Like a Noun? It is a Participle Phrase', 'Gerund phrases can easily be confused with participle phrases. It is possible, for example, to encounter the gerund phrase we used above in a context where it is not acting like a noun. When used as a modifier-that is, as an adjective or adverb-it is now a participle phrase. Example: Running with scissors, Tim charged after the cat. Here, running with scissors modifies the verb charged. It gives us further information about how Tim charged.');
                                                                     
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (19, 'Develop a reading habit', 'Vocabulary building is easiest when you encounter words in context. Seeing words appear in a novel or a newspaper article can be far more helpful than seeing them appear on vocabulary lists. Not only do you gain exposure to unfamiliar words; you also see how they are used.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (19, 'Use the dictionary and thesaurus', 'Online dictionaries and thesauruses are helpful resources if used properly. They can jog your memory about synonyms that would actually be better words in the context of what you are writing. A full dictionary definition can also educate you about antonyms, root words, and related words, which is another way to learn vocabulary.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (19, 'Play word games', 'Classic games like Scrabble and Boggle can function as a fun way to expand your English vocabulary. Crossword puzzles can as well. If you really want to be efficient, follow up rounds of these word games with a little note-taking. Keep a list of the different words you learned while playing the game, and then study that list from time to time.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (20, 'Direct Speech', 'When we want to describe what someone said, one option is to use direct speech. We use direct speech when we simply repeat what someone says, putting the phrase between speech marks: Paul came in and said, "I am really hungry." It is very common to see direct speech used in books or in a newspaper article. For example: The local MP said, "We plan to make this city a safer place for everyone."');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (20, 'Inirect Speech', 'When we want to report what someone said without speech marks and without necessarily using exactly the same words, we can use indirect speech (also called reported speech). For example: Direct speech: "We are quite cold in here." Indirect speech: They say (that) they are cold.');


-- Populating "quiz" Table
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (1, 'Python Quiz - Easy');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (1, 'Python Quiz - Medium');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (2, 'JS Quiz - Easy');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (3, 'C++ Quiz - Medium');

INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (6, 'Variance Quiz');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (7, 'Quadratic Formula Quiz');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (7, 'Quadratic Formula Quiz - II');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (8, 'Complex Numbers');

INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (11, 'Drawing Quiz');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (12, 'Conceptual Art');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (12, 'Conceptual Art - II');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (13, 'Ceramics Concepts');

INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (16, 'Parts of Speech Quiz');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (18, 'Gerands Basics');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (17, 'Use of Tenses');
INSERT INTO `quiz` (`tutorial_id`, `topic`) VALUES (18, 'Gerunds - II');

-- Populating "question" Table
-- Quiz 1 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (1, 'What is output for search. find(S)?', 's', '-1', 'None', 'A and B', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (1, 'What is output for b = [11,13,15,17,19,21] ptint(b[::2])', '[19,21]', '[11,15]', '[11,15,19]', ' [13,17,21]', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (1, 'Which of the function among will return 4 on the set s = {3, 4, 1, 2}?', 'Sum(s)', 'Len(s)', ' Max(s)', 'option 1 & 2', 'option4');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (1, 'In the following options which are python libraries which are used for data analysis and scientific computations', 'Numpy', 'OS', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (1, 'Suppose we have a set a = {10,9,8,7}, and we execute a.remove(14) what will happen ?', ' We cannot remove an element from set.', 'Key error is raised', 'option2');

-- Quiz 2 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (2, 'What is output of following : print(any.encode())', 'any', 'yan', 'bany', 'None', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (2, 'Select the correct function among them which can be used to write the data to perform for a binary output?', 'Write', 'Output.binary', 'Dump', 'Binary.output', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (2, 'What is output for b = [11,13,15,17,19,21] ptint(b[::2])', '[19,21]', '[11,15]', '[11,15,19]', ' [13,17,21]', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (2, 'Which built-in method returns the character at the specified index?', 'characterAt()', 'getCharAt()', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (2, 'What is output for search. find(S)?', 's', '-1', 'option2');

-- Quiz 3 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (3, 'Which of the following is true about typeof operator in JavaScript?', 'The typeof is a unary operator.', 'Its value is a string indicating the data type of the operand.', 'Both of the above.', 'None', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (3, 'Select the correct function among them which can be used to write the data to perform for a binary output?', 'Write', 'Output.binary', 'Dump', 'Binary.output', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (3, 'What is output for b = [11,13,15,17,19,21] ptint(b[::2])', '[19,21]', '[11,15]', '[11,15,19]', ' [13,17,21]', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (3, 'Can you pass a anonymous function as an argument to another function?', 'true', 'false', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (3, 'What is output for search. find(S)?', 's', '-1', 'option2');

-- Quiz 4 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (4, '‘cin’ is an __', 'Class', 'Object', 'Package', 'Namespace', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (4, 'The pointer which stores always the current active object address is __', 'auto_ptr', 'this', 'p', 'none of the above.', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (4, 'What is the full form of STL?', 'Standard template library.', 'System template library.', 'Standard topics library', ' None of the above.', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (4, 'Standard template library.', 'No', 'None', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (4, 'C++ can also be written as', 'Cpp', 'C+=', 'option1');

-- Quiz 5 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (5, 'Which of the following statistics cannot be negative?', 'Covariance', 'Variance', 'E(r)', 'None', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (5, 'You are given : 6,3,5,2,6,4,9. Which is not true?', 'model is 6', 'median is 5', 'mean is 6', 'range is 7', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (5, 'Which of the follow is not a measure of dispersion?', 'Range', 'Standard Deviation', 'Variance', 'Median', 'option4');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (5, 'To solve variance problems in python we can use', 'Cpp', 'numpy', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (5, 'What is statistical variance?', 'The square of the standard deviation', 'The square root of the standard deviation', 'option1');

-- Quiz 6 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (6, 'x^2 = 36. What is the value of x?', '6', '4', '9', '8', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (6, '2x^2 - 5x + 3 = 0, x is:', '1', '3/2', '2/3', 'A and B', 'option4');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (6, '3x^2 - x = 10', '-5/3', '2', '4', 'A and B', 'option4');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (6, ' (x - 7)(x - 9) = 195', '-6', '-22', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (6, 'x/3 +3/x =  4 1/4', '12', '-12', 'option1');

-- Quiz 7 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (7, 'x^2 = 36. What is the value of x?', '6', '4', '9', '8', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (7, '2x^2 - 5x + 3 = 0, x is:', '1', '3/2', '2/3', 'A and B', 'option4');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (7, 'An equation ax^2 + bx + c = 0 is called', 'Linear', 'Quadratic', 'Cubic', 'A and B', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (7, 'For a quadratic equation ax^2 + bx + c = 0', 'b != 0', 'a != 0', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (7, 'Another name for a quadratic equation is', 'Second Degree', 'Linear', 'option1');

-- Quiz 8 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (8, 'Which of the following statistics cannot be negative?', 'Covariance', 'Variance', 'E(r)', 'None', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (8, 'What is statistical variance?', 'The square of the standard deviation', 'The square root of the standard deviation', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (8, 'This is The Sixth Question For Python Quiz:', 'Yes', 'None', 'No', 'A and B', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (8, 'x^2 = 36. What is the value of x?', '6', '4', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (8, 'x/3 +3/x =  4 1/4', '12', '-12', 'option1');

-- Quiz 9 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (9, 'Which of the following statistics cannot be negative?', 'Covariance', 'Variance', 'E(r)', 'None', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (9, 'x/3 +3/x =  4 1/4', '12', '-12', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (9, 'This is The Sixth Question For Python Quiz:', 'Yes', 'None', 'No', 'A and B', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (9, 'Another name for a quadratic equation is', 'Second Degree', 'Linear', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (9, 'C++ can also be written as', 'Cpp', 'C+=', 'option1');

-- Quiz 10 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (10, 'Which of the following statistics cannot be negative?', 'Covariance', 'Variance', 'E(r)', 'None', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (10, 'Another name for a quadratic equation is', 'Second Degree', 'Linear', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (10, 'C++ can also be written as', 'Cpp', 'C+=', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (10, 'x/3 +3/x =  4 1/4', '12', '-12', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (10, 'Another name for a quadratic equation is', 'Second Degree', 'Linear', 'option1');

-- Quiz 11 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (11, 'x^2 = 36. What is the value of x?', '6', '4', '9', '8', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (11, 'This is The Second Question For Python Quiz:', 'Yes', 'No', 'None', 'A and B', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (11, 'This is The Sixth Question For Python Quiz:', 'Yes', 'None', 'No', 'A and B', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (11, 'Another name for a quadratic equation is', 'Second Degree', 'Linear', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (11, 'This is The Fourth Question For Python Quiz:', 'None', 'A and B', 'option1');

-- Quiz 12 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (12, 'What is output for search. find(S)?', 's', '-1', 'None', 'A and B', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (12, 'What is output for b = [11,13,15,17,19,21] ptint(b[::2])', '[19,21]', '[11,15]', '[11,15,19]', ' [13,17,21]', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (12, 'Which of the function among will return 4 on the set s = {3, 4, 1, 2}?', 'Sum(s)', ' Len(s)', ' Max(s)', 'option 1 & 2', 'option4');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (12, 'In the following options which are python libraries which are used for data analysis and scientific computations', 'Numpy', 'OS', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (12, 'Suppose we have a set a = {10,9,8,7}, and we execute a.remove(14) what will happen ?', ' We cannot remove an element from set.', 'Key error is raised', 'option2');

-- Quiz 13 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (13, 'What is output of following : print(any.encode())', 'any', 'yan', 'bany', 'None', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (13, 'Select the correct function among them which can be used to write the data to perform for a binary output?', 'Write', 'Output.binary', 'Dump', 'Binary.output', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (13, 'What is output for b = [11,13,15,17,19,21] ptint(b[::2])', '[19,21]', '[11,15]', '[11,15,19]', ' [13,17,21]', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (13, 'Which built-in method returns the character at the specified index?', 'characterAt()', 'getCharAt()', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (13, 'What is output for search. find(S)?', 's', '-1', 'option2');

-- Quiz 14 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (14, 'Which of the following is true about typeof operator in JavaScript?', 'The typeof is a unary operator.', 'Its value is a string indicating the data type of the operand.', 'Both of the above.', 'None', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (14, 'Select the correct function among them which can be used to write the data to perform for a binary output?', 'Write', 'Output.binary', 'Dump', 'Binary.output', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (14, 'What is output for b = [11,13,15,17,19,21] ptint(b[::2])', '[19,21]', '[11,15]', '[11,15,19]', ' [13,17,21]', 'option3');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (14, 'Can you pass a anonymous function as an argument to another function?', 'true', 'false', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (14, 'What is output for search. find(S)?', 's', '-1', 'option2');

-- Quiz 15 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (15, '‘cin’ is an __', 'Class', 'Object', 'Package', 'Namespace', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (15, 'The pointer which stores always the current active object address is __', 'auto_ptr', 'this', 'p', 'none of the above.', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (15, 'What is the full form of STL?', 'Standard template library.', 'System template library.', 'Standard topics library', ' None of the above.', 'option1');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (15, 'Standard template library.', 'No', 'None', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (15, 'C++ can also be written as', 'Cpp', 'C+=', 'option1');

-- Quiz 16 --
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (16, 'Which of the following statistics cannot be negative?', 'Covariance', 'Variance', 'E(r)', 'None', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (16, 'You are given : 6,3,5,2,6,4,9. Which is not true?', 'model is 6', 'median is 5', 'mean is 6', 'range is 7', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`)  VALUES (16, 'Which of the follow is not a measure of dispersion?', 'Range', 'Standard Deviation', 'Variance', 'Median', 'option4');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (16, 'To solve variance problems in python we can use', 'Cpp', 'numpy', 'option2');
INSERT INTO `question` (`quiz_id`, `statement`, `option1`, `option2`, `correct_option`)  VALUES (16, 'What is statistical variance?', 'The square of the standard deviation', 'The square root of the standard deviation', 'option1');
