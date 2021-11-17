class InsertUserResponse {
  final String message;

  InsertUserResponse(this.message);

  InsertUserResponse.fromJson(Map<String, dynamic> json)
      : message = json['message'];
}
