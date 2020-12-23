CREATE TABLE Users (
	user_id		number(10)     NOT NULL,
	first_name	varchar2(64)   NOT NULL,
	last_name 	varchar2(64),
	age		number(3),
	gender   	varchar2(8)    CHECK(gender IN('Male','Female','Other')),
	location	varchar2(24)   NOT NULL,
	email		varchar2(64)   UNIQUE,
	pwd	        varchar2(128)  NOT NULL,
	PRIMARY KEY (user_id)
);

CREATE TABLE Biography (
	bio_id		number(10),
	user_id   	number(10),
	text_body	varchar2(255)	NOT NULL,
	intent		varchar2(32)	NOT NULL  CHECK(intent IN( 'funny','serious','informative','witty','sarcastic','honest','edgy','sincere','light-hearted','silly','intellectual' )),
  	PRIMARY KEY (bio_id),
	FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Bio_Reactions (
	bio_reaction_id 	number(10),
        giving_user_id		number(10),
        receiving_user_id	number(10),
        reaction		varchar2(32) NOT NULL CHECK(reaction in ( 'Like', 'Dislike' )),
	PRIMARY KEY (bio_reaction_id),
	FOREIGN KEY (giving_user_id)     REFERENCES Users(user_id),
	FOREIGN KEY (receiving_user_id)  REFERENCES Users(user_id)
);

CREATE TABLE Prompts (
	prompt_id   number(10)     PRIMARY KEY,
	user_id     number         REFERENCES Users(user_id),
	response_1  varchar(255)   CHECK(response_1 IN ('Going to the gym',
							'Sleeping in',
							'Going out with friends',
							'Watch cartoons / TV ',
							'Staying in + watching a movie',
							'Read books',
							'Hiking / Outdoors activities',
						        'Shopping',
							'Going to the movies',
							'Yoga / Pilates',
							'Spending time with family')),

	response_2  varchar(255)   CHECK(response_2 IN ('Good sense of humor',
							'Reliable + Loyal',
							'Committed',
							'Trustworthy + Honest',
							'Easy-going + Open-minded',
							'Optimistic',
							'Sarcastic + Comedic',
							'Reserved + Quiet',
							'Spiritual',
							'Strong religious foundation',
							'Attentive to emotions',
							'Straightforward',
							'Polite',
							'Fun + Outgoing',
							'Spontaneous'))
);
							
CREATE TABLE Prompt_Reactions (
	prompt_reaction_id 	number(10),
 	giving_user_id	  	number(10),
  	receiving_user_id	number(10),
  	prompt1_reaction  	varchar2(32) 	NOT NULL CHECK(prompt1_reaction in ( 'Like', 'Dislike' )),
  	prompt2_reaction	varchar2(32) 	NOT NULL CHECK(prompt2_reaction in ( 'Like', 'Dislike' )),
	PRIMARY KEY (prompt_reaction_id),
  	FOREIGN KEY (giving_user_id) 	REFERENCES Users(user_id),
	FOREIGN KEY (receiving_user_id) REFERENCES Users(user_id)
);
							       
