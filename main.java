import java.sql.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;

public class main {
	
	private static Statement myStatement = null;
	private static ResultSet resultSet = null;
	
	public static void main(String[] args) {
		
		try {
			Connection connection = DriverManager.getConnection
					("jdbc:mysql://localhost/project" 
							+ "?user=root&password=");
			System.out.println("Connected Successfully");
			
			myStatement = connection.createStatement();
		/*	
			myStatement.executeUpdate("drop table if exists Subscribe;");
			myStatement.executeUpdate("drop table if exists Comment;");
			myStatement.executeUpdate("drop table if exists Rate;");
			myStatement.executeUpdate("drop table if exists Conference_has_editor;");
			myStatement.executeUpdate("drop table if exists Conference_has_reviewer;");
			myStatement.executeUpdate("drop table if exists Journal_has_editor;");
			myStatement.executeUpdate("drop table if exists Journal_has_reviewer;");
			//myStatement.executeUpdate("drop table if exists Collaborate;");
			myStatement.executeUpdate("drop table if exists Cites;");
			myStatement.executeUpdate("drop table if exists Decide;");
			myStatement.executeUpdate("drop table if exists Assign;");
			myStatement.executeUpdate("drop table if exists Review;");
			myStatement.executeUpdate("drop table if exists Write_paper;");
			myStatement.executeUpdate("drop table if exists Has_author;");
			myStatement.executeUpdate("drop table if exists Submit_to_conference;");
			myStatement.executeUpdate("drop table if exists Submit_to_journal;");
			myStatement.executeUpdate("drop table if exists Journal;");
			myStatement.executeUpdate("drop table if exists Conference;");
			myStatement.executeUpdate("drop table if exists Institution;");
			myStatement.executeUpdate("drop table if exists Paper;");
			myStatement.executeUpdate("drop table if exists User_role;");
			myStatement.executeUpdate("drop table if exists Editor;");
			myStatement.executeUpdate("drop table if exists Reviewer;");
			myStatement.executeUpdate("drop table if exists Author;");		
			myStatement.executeUpdate("drop table if exists User;");
			
			
			myStatement.executeUpdate("create table User (" 
					+ "email_address 	varchar(40)	primary key," 
					+ "name 			varchar(40) not null," 
					+ "lastname			varchar(40)	not null,"
					+ "password			varchar(10)	not null,"
					+ "date_of_birth	date," 
					+ "age				int,"
					+ "photo			BLOB"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Author("
					+ "author_email_address		varchar(40) primary key," 
					+ "avg_citations_per_paper 	int," 
					+ "webpage 					varchar(40),"
					+ "foreign key (author_email_address) references User(email_address)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Reviewer("
					+ "reviewer_email_address	varchar(40) primary key," 
					+ "webpage 					varchar(40),"
					+ "foreign key (reviewer_email_address) references User(email_address)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Editor("	
					+ "editor_email_address		varchar(40) primary key," 
					+ "webpage 					varchar(40),"
					+ "foreign key (editor_email_address) references User(email_address)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table User_role("	
					+ "email_address	varchar(40)," 
					+ "role 			varchar(40),"
					+ "primary key (email_address, role),"
					+ "foreign key (email_address) references User(email_address)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Paper("	
					+ "paper_id				varchar(40) primary key," 
					+ "title 				varchar(40) not null,"
					+ "abstract 			varchar(300) not null,"
					+ "date_of_publication	date,"
					+ "index_term 			varchar(70),"
					+ "file					BLOB not null,"
					+ "status   			varchar(70)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Institution("
					+ "institution_name		varchar(40) primary key," 
					+ "institution_webpage 	varchar(40) not null,"
					+ "avg_citations		float "
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Conference("
					+ "conference_name	varchar(40)," 
					+ "date 			date,"
					+ "location 		varchar (40),"
					+ "description 		varchar (40),"
					+ "primary key (conference_name,date,location)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Journal("
					+ "ISSN 				varchar(40) primary key," 
					+ "journal_name 		varchar(40) not null,"
					+ "year_of_publication	date not null"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Submit_to_journal("
					+ "paper_id		varchar(40)," 
					+ "ISSN			varchar(40),"
					+ "submission_date_j   date,"
					+ "primary key (paper_id, ISSN),"
					+ "foreign key (paper_id) references Paper(paper_id),"
					+ "foreign key (ISSN) references Journal(ISSN)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Submit_to_conference("
					+ "paper_id			varchar(40)," 
					+ "conference_name	varchar(40)," 
					+ "date 			date,"
					+ "location 		varchar (40),"
					+ "submission_date_c 			date,"
					+ "primary key (paper_id,conference_name,date,location),"
					+ "foreign key (paper_id) references Paper(paper_id),"
					+ "foreign key (conference_name,date,location) references Conference(conference_name,date,location)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Has_author("
					+ "author_email_address	varchar(40)," 
					+ "institution_name		varchar(40)," 
					+ "primary key (author_email_address,institution_name),"
					+ "foreign key (author_email_address) references Author(author_email_address),"
					+ "foreign key (institution_name) references Institution(institution_name)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Write_paper("
					+ "author_email_address	varchar(40)," 
					+ "paper_id 			varchar(40)," 
					+ "primary key (author_email_address,paper_id),"
					+ "foreign key (author_email_address) references Author(author_email_address),"
					+ "foreign key (paper_id) references Paper(paper_id)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Review("
					+ "reviewer_email_address	varchar(40)," 
					+ "paper_id 				varchar(40)," 
					+ "review_content			varchar(300),"
					+ "review_grade	 			int,"
					+ "primary key (reviewer_email_address,paper_id),"
					+ "foreign key (reviewer_email_address) references Reviewer(reviewer_email_address),"
					+ "foreign key (paper_id) references Paper(paper_id)"
					+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create table Assign("
			+ "reviewer_email_address	varchar(40)," 
			+ "paper_id 				varchar(40)," 
			+ "editor_email_address		varchar(40),"
			+ "primary key (reviewer_email_address, paper_id),"
			+ "foreign key (editor_email_address) references Editor(editor_email_address),"
			+ "foreign key (paper_id) references Paper(paper_id),"
			+ "foreign key (reviewer_email_address) references Reviewer(reviewer_email_address)"
			+ ")engine=InnoDB;"
			);
			
			myStatement.executeUpdate("create table Decide("
			+ "editor_email_address	varchar(40)," 
			+ "paper_id 			varchar(40)," 
			+ "decision				varchar(20),"
			+ "primary key (editor_email_address,paper_id),"
			+ "foreign key (editor_email_address) references Editor(editor_email_address),"
			+ "foreign key (paper_id) references Paper(paper_id)"
			+ ")engine=InnoDB;"
			);

			myStatement.executeUpdate("create table Cites("
					+ "paper_id		varchar(40)," 
					+ "reference_id varchar(40)," 
					+ "primary key (paper_id,reference_id),"
					+ "foreign key (paper_id) references Paper(paper_id),"
					+ "foreign key (reference_id) references Paper(paper_id)"
					+ ")engine=InnoDB;"
					);
			
			/*myStatement.executeUpdate("create table Collaborate("
			+ "institution_name			varchar(40)," 
			+ "collaborative_inst_name	varchar(40)," 
			+ "primary key (institution_name,collaborative_inst_name),"
			+ "foreign key (institution_name) references Institution(institution_name),"
			+ "foreign key (collaborative_inst_name) references Institution(institution_name)"
			+ ")engine=InnoDB;"
			);
	*/
			/*
		myStatement.executeUpdate("create table Journal_has_reviewer("
				+ "ISSN  					varchar(40)," 
				+ "reviewer_email_address	varchar(40)," 
				+ "primary key (ISSN,reviewer_email_address),"
				+ "foreign key (ISSN) references Journal(ISSN),"
				+ "foreign key (reviewer_email_address) references Reviewer(reviewer_email_address)"
				+ ")engine=InnoDB;"
				);
		
		myStatement.executeUpdate("create table Journal_has_editor("
				+ "ISSN  				varchar(40)," 
				+ "editor_email_address		varchar(40)," 
				+ "primary key (ISSN,editor_email_address),"
				+ "foreign key (ISSN) references Journal(ISSN),"
				+ "foreign key (editor_email_address) references Editor(editor_email_address)"
				+ ")engine=InnoDB;"
				);
		
		myStatement.executeUpdate("create table Conference_has_reviewer("
				+ "reviewer_email_address	varchar(40)," 
				+ "conference_name			varchar(40)," 
				+ "date 					date,"
				+ "location 				varchar (40),"
				+ "primary key (reviewer_email_address,conference_name,date,location),"
				+ "foreign key (reviewer_email_address) references Reviewer(reviewer_email_address),"
				+ "foreign key (conference_name,date,location) references Conference(conference_name,date,location)"
				+ ")engine=InnoDB;"
				);
		
		myStatement.executeUpdate("create table Conference_has_editor("
				+ "editor_email_address	varchar(40)," 
				+ "conference_name			varchar(40)," 
				+ "date 					date,"
				+ "location 				varchar (40),"
				+ "primary key (editor_email_address,conference_name,date,location),"
				+ "foreign key (editor_email_address) references Editor(editor_email_address),"
				+ "foreign key (conference_name,date,location) references Conference(conference_name,date,location)"
				+ ")engine=InnoDB;"
				);
		
		myStatement.executeUpdate("create table Rate("
				+ "email_address	varchar(40)," 
				+ "paper_id			varchar(40)," 
				+ "rating_points	int," 
				+ "primary key (email_address,paper_id),"
				+ "foreign key (email_address) references User(email_address),"
				+ "foreign key (paper_id) references Paper(paper_id)"
				+ ")engine=InnoDB;"
				);
		
		myStatement.executeUpdate("create table Comment("
				+ "email_address	varchar(40)," 
				+ "paper_id			varchar(40)," 
				+ "comment_content 	varchar(120)," 
				+ "primary key (email_address,paper_id),"
				+ "foreign key (email_address) references User(email_address),"
				+ "foreign key (paper_id) references Paper(paper_id)"
				+ ")engine=InnoDB;"
				);
		
		myStatement.executeUpdate("create table Subscribe("
				+ "email_address	varchar(40)," 
				+ "ISSN				varchar(40)," 
				+ "start_date		date not null," 
				+ "end_date			date not null,"
				+ "primary key (email_address,ISSN),"
				+ "foreign key (email_address) references User(email_address),"
				+ "foreign key (ISSN) references Journal(ISSN)"
				+ ")engine=InnoDB;"
				);
	*/
		
		myStatement.executeUpdate("create or replace view Submitted_editor_J as "
				+ "select paper_id, title, email_address, role, name, submission_date_j, institution_name " 
				+ "from Paper natural join Submit_to_journal natural join Journal_has_editor natural join Write_paper natural join User natural join Has_author natural join User_role " 
				+ "where author_email_address = email_address and paper_id not in ( "
				+ "select paper_id "
				+ "from Decide) " 
				//+ ")engine=InnoDB;"
				);
		
		myStatement.executeUpdate("create or replace view Submitted_editor_C as "
				+ "select paper_id, title, email_address, role, name, submission_date_c, institution_name " 
				+ "from Paper natural join Submit_to_conference natural join Conference_has_editor natural join Write_paper natural join User natural join Has_author natural join User_role " 
				+ "where paper_id not in ( "
				+ "select paper_id "
				+ "from Decide) " 
				//+ ")engine=InnoDB;"
				);
		
		
		
			
			
			myStatement.executeUpdate("create or replace view papers_and_reviewers (assigned_reviewer, no_of_papers) as "
					+ "( select reviewer_email_address, count(paper_id) as no_assigned " 
					+ "from Assign " 
					+ "group by reviewer_email_address ) " 
					//+ ")engine=InnoDB;"
					);
			
			myStatement.executeUpdate("create or replace view reviews_and_reviewers ( reviewed_reviewers, no_of_reviews, no) as "
					+ "( select reviewer_email_address, count(paper_id) as no_reviewed, count(review_content) as no " 
					+ "from Review " 
					//+ "where review_content is not null and review_grade is not null " 
					+ "group by reviewer_email_address ) " 
					//+ ")engine=InnoDB;"
					);
			myStatement.executeUpdate("create or replace view assigned_and_reviewed ( assigned_reviewed, rev_name, no_of_papers, no) as "
					+ "( SELECT distinct assigned_reviewer, name, no_of_papers, no  " 
					+ "FROM User as u, User_role as ur, papers_and_reviewers , reviews_and_reviewers  " 
					+ "WHERE u.email_address = assigned_reviewer and assigned_reviewer = reviewed_reviewers and role = 3 and no_of_papers - no <= 5 )" 
					//+ ")engine=InnoDB;"
					);
			
			
			
			}
		
		
		catch(Exception e) {
			e.printStackTrace();
		}	
		
	}
}