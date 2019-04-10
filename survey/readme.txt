three databases under 'surveyusers'

user:
primary key: <username varchar(60), email varchar(60)>
pass varchar(20)
verify_hash varchar(32)
verified int(1)
survey_url varchar(80)

surveys:
primary key: <username varchar(60), survey_url varchar(70)>
survey_title varchar(140)
survey_desc varchar(400)
start date
end date
type1q1text tinytext through type1q5text tinytext
type2q1text tinytext through type2q5text tinytext

answers:
primary key: <survey_url varchar(70), responder varchar(60)>
type1q1 int(5) through type1q5 int(5)
type2q1 text   through type2q2 text
hasFinished int(1)