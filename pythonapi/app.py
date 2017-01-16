from flask import Flask
app = Flask(__name__)

import json

from db import DBSession
from models import Movie, Person, Vote


@app.route('/')
@app.route('/movies')
def list_movies():
    """
    Get the list of all movies ordered by name.
    """
    movies = DBSession.query(Movie).order_by(Movie.name)

    movie_list = []
    for movie in movies:
        movie_list.append(movie.as_dict())

    json_data = {'movies': movie_list}
    return json.dumps(json_data)




@app.route('/people')
def list_people():
    """
    Get the list of all people ordered by name.
    """
    people = DBSession.query(Person).order_by(Person.name)

    # this is more compact, using a list comprehension.
    json_data = {'people': [person.as_dict() for person in people]}
    return json.dumps(json_data)


@app.route('/votes')
def list_votes():
    """
    Get the list of all votes.
    """
    json_data = {'votes': [vote.as_dict() for vote in DBSession.query(Vote)]}
    return json.dumps(json_data)


@app.route('/vote/<int:person_id>/<int:movie_id>', methods=['POST'])
def cast_vote(person_id, movie_id):
    """
    Submit a vote, one user to one movie. Return whether the vote was cast.
    """
    # this query returns None if no rows are returned
    exists = DBSession.query(Vote).filter_by(person_id=person_id, movie_id=movie_id).first()

    if exists:
        result = {
            "result": "ERROR",
            "message": "Person has already voted for this movie."
        }
        # HTTP status code 409 means "conflict"
        return json.dumps(result), 409
    else:
        # create a new Vote and save it to the database
        vote = Vote(person_id=person_id, movie_id=movie_id)
        DBSession.add(vote)
        DBSession.commit()
        result = {"result": "OK", "message": "Vote registered."}
        return json.dumps(result)


app.run(host='0.0.0.0', port=8000, debug=True)
