db.createUser(
	{
		user: 'root',
		pwd: 'root',
		roles: [
			{
				role: 'readWrite',
				db: 'challengedb'
			}
		]
	}
)
db = db.getSiblingDB('challengedb')
db.createCollection('items')