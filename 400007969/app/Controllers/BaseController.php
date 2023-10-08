<?php
use App\Config\Config;
use App\Libs\Validators\IValidator;
use App\Service\Database;

/**
 * Abstract base controller class.
 */
abstract class BaseController {
	protected $view;
	protected $model;
	/**
	 * The database connection.
	 *
	 * @var Database
	 */
	private Database $database;

	/**
	 * The validator object.
	 *
	 * @var IValidator|null
	 */
	protected ?IValidator $validator = null;

	/**
	 * Constructs a new base controller.
	 *
	 * @param IValidator|null $validator The validator object.
	 */
	public function __construct(?IValidator $validator = null) {
		// $this->view = $view;
		// $this->model = $model;
		$this->validator = $validator;
		$this->database = new Database(
			Config::getDatabaseHost(),
			Config::getDatabasePort(),
			Config::getDatabaseUsername(),
			Config::getDatabasePassword(),
			Config::getDatabaseName(),
		);
	}

	public function render() {
		$this->view->render();
	}

	/**
	 * Redirects the user to the given URL.
	 *
	 * @param string $url The URL to redirect to.
	 *
	 * @return void
	 */
	public function redirect($url) {
		header('Location: ' . $url);
		exit();
	}
	/**
	 * Sets the validator object.
	 *
	 * @param IValidator|null $validator The validator object.
	 *
	 * @return void
	 */
	public function setValidator(?IValidator $validator) {
		$this->validator = $validator;
	}

	/**
	 * Gets the validator object.
	 *
	 * @return IValidator|null The validator object.
	 */
	public function getValidator(): ?IValidator {
		return $this->validator;
	}

	/**
	 * Validates the given data.
	 *
	 * @param array $values The data to validate.
	 *
	 * @return bool True if the data is valid, false otherwise.
	 */
	public function validate(array $values): bool {
		if (!$this->validator) {
			trigger_error(
				'No validation class is available for the `' .
					get_called_class() .
					'` . This means that the user input will not be validated.',
				E_USER_WARNING,
			);
			return false;
		}
		// Return the result of the validation.
		return $this->validator->isValid($values);
	}

	/**
	 * Gets the database connection.
	 *
	 * @return Database The database connection.
	 */
	public function getDatabase() {
		return $this->database;
	}
}