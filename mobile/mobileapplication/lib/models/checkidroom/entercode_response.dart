import 'package:equatable/equatable.dart';

class EnterCodeResponse extends Equatable {
  final String message;
  final bool isgo;

  EnterCodeResponse({
    required this.message,
    required this.isgo,
  });

  EnterCodeResponse.fromJson(Map<String, dynamic> json)
      : message = json['message'],
        isgo = json['isgo'];

  @override
  List<Object?> get props => [message, isgo];
}
