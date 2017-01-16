from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker, scoped_session
from sqlalchemy.ext.declarative import declarative_base

# Hard-coded database config for now,  should be in a nice config file.
# We use "python3-mysql.connector" because it works with Python 3,
# the default driver mysql:// will only work with Python 2.
engine = create_engine("mysql+mysqlconnector://movie:@localhost/movie")

DBSession = scoped_session(sessionmaker())
DBSession.configure(bind=engine)

Model = declarative_base()
