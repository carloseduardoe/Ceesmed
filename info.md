Table Names -> The "snake case" plural name of the class will be used as the table name.
  Specify a custom table by defining a table property on your model:
  protected $table = 'tableName';

Primary Keys -> Eloquent will assume that each table has an incrementing integer primary key column named id.
  You may define a protected $primaryKey property to override this convention:
  protected $primaryKey = 'primaryKey';

  If you wish to use a non-incrementing or a non-numeric primary key set the public $incrementing property on your model to false:
  public $incrementing = false;

  If the primary key is not an integer set the protected $keyType property on your model to string:
  protected $keyType = 'string';

Timestamps -> Eloquent expects created_at and updated_at columns to exist on your tables.
  If you do not wish to have these columns automatically managed by Eloquent, set the $timestamps property on your model to false:
  public $timestamps = false;

  To customize the names of the columns set the constants CREATED_AT and UPDATED_AT in the model:
  const CREATED_AT = 'createdColumn';
  const UPDATED_AT = 'updatedColumn';

  To customize the format of the timestamps, set the $dateFormat property on the model:
  protected $dateFormat = 'U';

Database Connection -> Eloquent models will use the default database connection configured for the application.
  To specify a different connection for the model, use the $connection property:
  protected $connection = 'connection-name';
